<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .btn-custom {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-5">Szevasz, <b><?php echo htmlspecialchars($_SESSION["felhasznalonev"]); ?></b>! Isten hozott!</h1>
        <p>
            <a href="reset-password.php" class="btn btn-warning btn-custom">JelszoCsere</a>
            <a href="logout.php" class="btn btn-danger btn-custom">Kijelentkezes</a>
        </p>
        <p>
            <a href="level1.php" class="btn btn-primary btn-custom">Elso palya</a>
            <a href="level<?php echo $_SESSION['maxszint']; ?>.php" class="btn btn-success btn-custom">Jatek folytatasa</a>
            <a href="leaderboard.php" class="btn btn-info btn-custom">Dicsosegfal</a>
        </p>
    </div>
</body>
</html>