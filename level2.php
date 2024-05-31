<?php
session_start();
require_once "config.php";

// Csak belepett felhasznalo fer hozza
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){	//|| $_SESSION["maxszint"] < 2 korabban volt, de a szerver inkonzisztens mukodese miatt kivettem sajnos (reszletesebben az increase_level.php ban nyavalygok errol)
    // A tobbieket kijelentkeztetve visszakuldjuk a bejelentkezokepernyore, mert megprobaltak csalni (ugy felmenni a masodik palya linkjere, hogy meg nem ertek el)
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
        }
        canvas {
            display: block;
        }
    </style>
</head>
<body>
    <canvas></canvas>
    <script src="./js2/classes/Egyebek.js"></script>
    <script src="./js2/classes/Platformok.js"></script>
    <script src="./js2/classes/Spriteok.js"></script> <!-- HAMARABB KELL MINT AMI EXTENDELI AAAA -->
    <script src="./js2/classes/Jatekosok.js"></script>
    <script src="./js2/data/PlatformPoziciok.js"></script>
    <script src="./js2/index.js"></script>
</body>
</html>