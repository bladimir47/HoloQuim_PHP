<?php
session_start(); 
include('./conexion/conexion.php');
$nombre = $_SESSION['nombre'];
if ( $_SESSION['nomg'] == "holo"  ) {
	if (isset($_FILES['archivo'])) {
	    
	    $query = "SELECT count(*) as valor FROM ejemplos ";
		$result = $mysqli->query($query);
		$obj = $result->fetch_object();
		$valor = $obj->valor;
					
		$nombrearchivo = $valor."_".$_FILES['archivo']['name'];
				  
		if(move_uploaded_file($_FILES['archivo']['tmp_name'],'./videoejemplo/'.$nombrearchivo)){
			echo $nombrearchivo;
		}else {
			echo 0;
		}

	}
}

/*
if (isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo'];
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
	$time = time();
    $nombre = "Mio";
    if (move_uploaded_file($archivo['tmp_name'], "videoejemplo/$nombre")) {
        echo 1;
    } else {
        echo 0;
    }
}*/

?>
