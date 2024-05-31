<?php
/* Csatlakozasi adatok */
define('DB_SERVER', 'mysql.caesar.elte.hu');
define('DB_USERNAME', 'kenermester');
define('DB_PASSWORD', '2iXX9K11dv6GCpBQ');
define('DB_NAME', 'kenermester');

/* Csatlakozas adatbazishoz */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Hibauzenet, ha nem sikerult
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>