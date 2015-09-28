<?php
session_start();
include('./conexion/conexion.php');
$msg = "";
$mensajes = "";

	
	$correo = $_POST['inputEmail'];
	$contra = $_POST['inputPassword'];	
    
	
		if($contra!=null && $correo!=null  )
		{
			$query = "SELECT `idusuario` FROM `usuario` WHERE `correo` = '".$correo."' and `pass` = '".$contra."'";
			$result = $mysqli->query($query);
			$obj = $result->fetch_object();
			if($obj->idusuario){
                $varmd5 = md5("holoquim");
				$mensajes = "proye";
				echo $msg = "http://chocolatescript.tk/holoquim/inicio.php?cla=".$varmd5;
			}else{
				$msg = "http://chocolatescript.tk/holoquim"; 
			}
			$result->close();
			unset($obj);
			unset($sql);
			unset($query);
			
			
		}else { 
			$msg = "http://chocolatescript.tk/holoquim"; 	
		}
                
    
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<!-- HEAD SECTION -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
   <title>Proyecta</title>
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--BOOTSTRAP MAIN STYLES -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--FONTAWESOME MAIN STYLE -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--CUSTOM STYLE -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
		location.href="<?php echo $msg; ?>"; //tiempo expresado en milisegundos
	</script>
</head>
    <!--END HEAD SECTION -->
<body>   

</body>
</html>