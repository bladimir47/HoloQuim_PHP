<?php
	include('./conexion/conexion.php');
	header('Content-Type: text/html; charset=utf-8'); 
	header('Access-Control-Allow-Origin: *');
	$valorrea = $_GET['reacc'];
	
	$mensaje2 = array();
	$verificacion = -1;
	$sql = "SELECT  `Titulo`, `texto`, `dirvidieo` FROM `ejemplos` WHERE `reaccion_idreaccion` = ".$valorrea;
	try{
		if ($result = $mysqli->query($sql)) {
			while($obj = $result->fetch_object()){

				$temporal1 = array('Titulo' => $obj->Titulo, 'Texto' => $obj->texto, 'video'=> $obj->dirvidieo);
				array_push($mensaje2,$temporal1);
				$verificacion = 1;
			}
		}else{
			$verificacion = -1;
		}
	}catch(Exception $e){
		$verificacion = -1;
	}

	//json de prueba entrada: {"siguiente":0}
	//json de prueba salida1: {"noticias":[{"Titulo":"Primera fecha","Texto":"Realizaremos las primeras fechas para la entrega de nuevos eventos"},{"Titulo":"Gran evento","Texto":"Se tomara los datos de todas las personas que tengan problemas"}]}
	//print_r($mensaje2);
	$mensaje = array('reacciones' => $mensaje2);
	echo json_encode($mensaje);
	//base64_encode(json_encode( $mensaje));
?>