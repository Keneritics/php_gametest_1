<?php
require_once "config.php";
session_start();
 
// Ha be van lepve, atiranyitjuk a fooldalra egybol
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Inicializalunk par valtozot
$felhasznalonev = $jelszo = "";
$felhasznalonev_err = $jelszo_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Feldolgozas

    if(empty(trim($_POST["felhasznalonev"]))){
        $felhasznalonev_err = "A felhasznalonevet ne hagyja uresen!";
    } else{
        $felhasznalonev = trim($_POST["felhasznalonev"]);
    }
    
    if(empty(trim($_POST["jelszo"]))){
        $jelszo_err = "A jelszot ne hagyja uresen!";
    } else{
        $jelszo = trim($_POST["jelszo"]);
    }
    
    // Ha nincs hiba, kikeressuk az adatbazisbol a felhasznalot
    if(empty($felhasznalonev_err) && empty($jelszo_err)){

        $sql = "SELECT id, felhasznalonev, jelszo, maxszint FROM felhasznalo WHERE felhasznalonev = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_felhasznalonev);
            
            $param_felhasznalonev = $felhasznalonev;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                // Ha letezik a felhasznalo, megnezzuk, hogy passzol e a jelszo
                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    mysqli_stmt_bind_result($stmt, $id, $felhasznalonev, $hashed_jelszo, $maxszint);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($jelszo, $hashed_jelszo)){
                            // ha igen, kezdodhet a session
                            session_start();
                            
                            // A session valtozoiban eltaroljuk az adatokat
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["felhasznalonev"] = $felhasznalonev;
                            $_SESSION["maxszint"] = $maxszint;              //Vegso simitasok kozben elkezdtem erre is gyanakodni, lehet, hogy emiatt lesz tul nagyra novelve(??)
                            
                            // Beengedjuk az udvozlooldalra
                            header("location: welcome.php");
                        } else{
                            // Hibauzenet, ha a jelszo nem stimmel
                            $jelszo_err = "A jelszo nem stimmel..";
                        }
                    }
                } else{
                    $felhasznalonev_err = "Nincs is ilyen felhasznalo meg...";
                }
            } else{
                echo "Hiba! Probald ujra kesobb!";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Kapcsolat bontasa
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: auto; margin-top: 50px; }
        .btn-custom {
            margin: 10px;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <h2>Bejelentkezes</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($felhasznalonev_err)) ? 'has-error' : ''; ?>">
                <label>Felhasznalonev:</label>
                <input type="text" name="felhasznalonev" class="form-control" value="<?php echo $felhasznalonev; ?>">
                <span class="help-block"><?php echo $felhasznalonev_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($jelszo_err)) ? 'has-error' : ''; ?>">
                <label>Jelszo:</label>
                <input type="password" name="jelszo" class="form-control">
                <span class="help-block"><?php echo $jelszo_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Bejelentkezes">
            </div>
            <p>Nincs fiokod? <a href="register.php">Regisztralj!</a>.</p>
        </form>
    </div>

</body>
</html>