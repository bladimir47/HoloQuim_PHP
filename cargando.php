<?php
session_start(); 
header('Content-Type: text/html; charset=utf-8'); 
header('Access-Control-Allow-Origin: *');
include('./conexion/conexion.php');
$nombre = $_SESSION['nombre'];
$msg = "";
$mensaje = "No se cargo";
$tabla = "";
if ( $_SESSION['nomg'] == "holo"  ) {
	if(isset($_POST['subi'])){
		if ($_FILES['archivo']["error"] > 0)
		  {
				echo "Error: " . $_FILES['archivo']['error'] . "<br>";
				
		  }	else
		  {
			  $titulo = $_POST['titulo'];
			  $texto = $_POST['conte'];
			  $msg = "?notificaciones=".$notificacion;
			  
				$query = "SELECT count(*) as valor FROM reaccion ";
				$result = $mysqli->query($query);
				$obj = $result->fetch_object();
				$valor = $obj->valor;
				
				$nombrearchivo = $valor."_".$_FILES['archivo']['name'];
			  
			  move_uploaded_file($_FILES['archivo']['tmp_name'],'./imagenesnoti/'.$nombrearchivo);
			  
			  $query = "INSERT INTO reaccion( titulo, texto, dirimagen) VALUES ( '". $titulo ."','".$texto."','".$nombrearchivo."')";
			  $mysqli->query($query);
			  unset($query);
			  
			  
			  
			  $mensaje = "Cargado";
		  }
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HoloQuim</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color: #F8732B;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">HoloQuim</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="inicio.php">Inicio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="reaccion.php">Reaccion</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Comentario</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
     <br/>
    <br/>
    <br/>
    <form action="reaccion.php" method="post">
        <div class="row">
            <div class="container col-md-4">
            </div>
            <div class="container col-md-4">
                <center><button class="btn btn-primary btn-xl page-scroll" id="datos" name="datos"  type="submit"><?=$mensaje;?>,Regresar</button></center>
            </div>
        </div >
    </form>
    <br/>
    <br/>
    <br/>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

</body>

</html>