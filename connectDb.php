<?php
$server = 'localhost';
$user = 'renan';
$pswd = 'renan!!!';
$db = 'records2';

$mysqli = new mysqli($server, $user, $pswd, $db);

//Exibe erro na coenxão com a DB
mysqli_report(MYSQLI_REPORT_ERROR); 

?>