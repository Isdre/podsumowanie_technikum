<?php
$dbServer = 'localhost';
$dbUser = 'ToDo';
$dbPassword = 'ADE8(cAfS[b0_M2i';
$dbName = 'tech';

$mysqli = new mysqli($dbServer,$dbUser,$dbPassword,$dbName);
$mysqli->set_charset("utf8");
if ( mysqli_connect_errno() ) {
	echo 'Błąd bazy danych';
}