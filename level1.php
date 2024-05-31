<?php
session_start();
require_once "config.php";

// Csak a belejelentkezett felhasznalo fer hozza, akinek legalabb a palya szamaval egyenlo a maxszintje
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["maxszint"] < 1){
    // Redirect to logout page to logout the user
    header("location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plat_Former_Demo</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        canvas {
            display: block;
        }
        .btn-container {
            margin-top: 20px;
        }
        .btn-container button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <canvas></canvas>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/classes/Egyebek.js"></script>
    <script src="./js/classes/Platformok.js"></script>
    <script src="./js/classes/Spriteok.js"></script> <!-- HAMARABB KELL MINT AMI EXTENDELI AAAA -->
    <script src="./js/classes/Jatekosok.js"></script>
    <script src="./js/data/PlatformPoziciok.js"></script>
    <script src="./js/index.js"></script>
    <div class="btn-container">
        <a href="https://github.com/blackmare420/KacifantosFeltoltes">
            <button>-->Forr�sk�d GitHub Repozit�riuma<--</button>
        </a>
    </div>
</body>
</html>