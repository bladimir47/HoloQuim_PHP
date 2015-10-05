<?php


$dbhost = 'mysql.hostinger.es'; 
$dbuser = 'u353327905_hq'; 
$dbpass = 'EQfhPI6nzH'; 
$dbname = 'u353327905_hq'; 

// Creando conexion.
//$link = mysql_connect($dbhost,$dbuser,$dbpass);
//		mysql_select_db($dbname,$link);
		
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    echo "Fallo la conexion a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
		
		
?>