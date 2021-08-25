<?php
$server = 'localhost';
$user = 'renan';
$pswd = 'renan!!!';
$db = 'records2';

$mysqli = new mysqli($server, $user, $pswd, $db);

mysqli_report(MYSQLI_REPORT_ERROR); //ONLY USE this while developing the website, comment after

?>