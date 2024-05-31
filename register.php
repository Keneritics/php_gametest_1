<?php
require_once "config.php";

// Valtozok inicializalasa uresre
$felhasznalonev = $jelszo = "";
$felhasznalonev_err = $jelszo_err = "";

// Urlap adatainak feldolgozasa
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Felhasznalonev legyen
    if(empty(trim($_POST["felhasznalonev"]))){
        $felhasznalonev_err = "Adjon meg felhasznalonevet!";
    } else{
        $felhasznalonev = trim($_POST["felhasznalonev"]);
    }
    
    // Jelszo legyen
    if(empty(trim($_POST["jelszo"]))){
        $jelszo_err = "Adjon meg jelszot!";     
    } else{
        $jelszo = trim($_POST["jelszo"]);
    }
    
    // Ha nincs hiba, hozzadhatjuk a felhasznalot! (mindenki 1-es szintrol indul)
    if(empty($felhasznalonev_err) && empty($jelszo_err)){
        $sql = "INSERT INTO felhasznalo (felhasznalonev, jelszo, maxszint) VALUES (?, ?, 1)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_felhasznalonev, $param_jelszo);
            
            // A jelszot persze hashelve adjuk at
            $param_felhasznalonev = $felhasznalonev;
            $param_jelszo = password_hash($jelszo, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
                exit();
            } else{
                echo "Hiba:";
                echo "Error: " . mysqli_error($link);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Failed to prepare the SQL statement.";
            echo "Error: " . mysqli_error($link);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Regisztracio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ width: 350px; margin: 0 auto; }
        .form-group { margin-bottom: 1rem; }
        .form-control { width: 100%; }
        .has-error .form-control { border-color: #dc3545; }
        .help-block { color: #dc3545; }
    </style>
</head>

<body>

    <div class="wrapper">
        <h2>Regisztracio</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($felhasznalonev_err)) ? 'has-error' : ''; ?>">
                <label>Felhasznalonev</label>
                <input type="text" name="felhasznalonev" class="form-control" value="<?php echo $felhasznalonev; ?>">
                <span class="help-block"><?php echo $felhasznalonev_err;?></span>
            </div>

            <div class="form-group <?php echo (!empty($jelszo_err)) ? 'has-error' : ''; ?>">
                <label>Jelszo</label>
                <input type="password" name="jelszo" class="form-control">
                <span class="help-block"><?php echo $jelszo_err;?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Megerosites">
            </div>
        </form>
    </div>

</body>
</html>