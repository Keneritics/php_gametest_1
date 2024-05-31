<?php
session_start();
 
// Kiuritjuk a session valtozokat
$_SESSION = array();
 
session_destroy();
 
// Visszairanyitunk a belepooldara
header("location: login.php");
exit;
?>