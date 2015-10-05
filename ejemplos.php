<?php
session_start();
//header('Content-Type: text/html; charset=utf-8'); 
header('Access-Control-Allow-Origin: *');
include('./conexion/conexion.php');
$nombre = $_SESSION['nombre'];
$contenido ="";

if ( $_SESSION['nomg'] == "holo" ) {
    $idreaccion = $_GET['idreac'];
    $eliminar = $_POST['eliminar'];
    $contenido = $contenido."?noti=".$clave;
    if($eliminar!=null )
    {
        $query = "SELECT `dirimagen` FROM `reaccion` WHERE `idreaccion` = ".$eliminar;
        $result = $mysqli->query($query);
        $obj = $result->fetch_object();
        unlink('./imagenesnoti/'.$obj->dirimagen);
        $query = "DELETE FROM `reaccion` WHERE `idreaccion` = ".$eliminar;
        $mysqli->query($query);
                        
    } 
    
    $sql = "SELECT `idejemplos`, `Titulo`, `texto`, `dirvidieo`, `reaccion_idreaccion` FROM `ejemplos` WHERE `reaccion_idreaccion` = ".$idreaccion;
        if ($result = $mysqli->query($sql)) {
            while($obj = $result->fetch_object()){
                $tabla = $tabla.'<tr>';
                $tabla = $tabla.'<td>'.$obj->Titulo.'</td>';
                $tabla = $tabla.'<td>'.$obj->texto.'</td>';
                $tabla = $tabla.'<td><a href="http://chocolatescript.tk/holoquim/videoejemplo/'.$obj->dirvidieo.'"  target="_blank" class="btn btn-success btn-xs">Descargar archivo</a></td>';
                $tabla = $tabla.'<td><form action="ejemplos.php?idreac="'.$idreaccion.' method="post">';
                $tabla = $tabla.'<button class="btn btn-default btn-sm" name="eliminar" value="'.$obj->idejemplos.'">Eliminar</button>';
                $tabla = $tabla.'</form></td>';
                $tabla = $tabla.'</tr>';
            }
        }
        $result->close();
        unset($obj);
        unset($sql);
        unset($query);
        echo $textos;
    
    
}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
        <title>Ejemplos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Css -->
        <link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
        <!-- Javascript -->
        <script src="js/jquery-2.0.2.js"></script>
        <script src="js/upload.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function subirArchivos() {
                $("#archivo").upload('subir_archivo.php',
                {
                    nombre_archivo: $("#titulo").val()
                },
                function(respuesta) {
                    //Subida finalizada.
                    $("#barra_de_progreso").val(0);
                    if (respuesta !== 0) {
                        mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                        $("#ppp, #archivo").val(''+respuesta);
                    } else {
                        mostrarRespuesta('El archivo NO se ha podido subir.', false);
                    }
                    mostrarArchivos();
                }, function(progreso, valor) {
                    //Barra de progreso.
                    $("#barra_de_progreso").val(valor);
                });
            }
            function eliminarArchivos(archivo) {
                $.ajax({
                    url: 'eliminar_archivo.php',
                    type: 'POST',
                    timeout: 10000,
                    data: {archivo: archivo},
                    error: function() {
                        mostrarRespuesta('Error al intentar eliminar el archivo.', false);
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                            mostrarRespuesta('El archivo ha sido eliminado.', true);
                        } else {
                            mostrarRespuesta('Error al intentar eliminar el archivo.', false);                            
                        }
                        mostrarArchivos();
                    }
                });
            }
            function mostrarArchivos() {
                $.ajax({
                    url: 'mostrar_archivos.php',
                    dataType: 'JSON',
                    success: function(respuesta) {
                        if (respuesta) {
                            var html = '';
                            for (var i = 0; i < respuesta.length; i++) {
                                if (respuesta[i] != undefined) {
                                    html += '<div class="row"> <span class="col-lg-2"> ' + respuesta[i] + ' </span> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div> <hr />';
                                }
                            }
                            $("#archivos_subidos").html(html);
                        }
                    }
                });
            }
            function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success');
                }else{
                    $("#respuesta").addClass('alert-danger');
                }
            }
            $(document).ready(function() {
                mostrarArchivos();
                $("#boton_subir").on('click', function() {
                    subirArchivos();
                });
                $("#archivos_subidos").on('click', '.eliminar_archivo', function() {
                    var archivo = $(this).parents('.row').eq(0).find('span').text();
                    archivo = $.trim(archivo);
                    eliminarArchivos(archivo);
                });
            });
        </script>
    </head>
    <bodyid="page-top">

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
    <br />
    <br />
    <br />
    <div id="respuesta" class="alert"></div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-6">
      
            <form  action="cargandovideo.php?idreac=<?=$idreaccion;?> " method="post">
              <div >
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
                <br/>
                <input type="text" class="form-control" id="conte" name="conte" placeholder="Texto">
                <br/>
                <input type="text" class="form-control" id="ppp" name="ppp" placeholder="Video">
                <br/>
              </div>
              <br />
              <button type="submit" name="subi" class="btn btn-danger">Publicar</button>
            </form>
            <br>
            <form action="javascript:void(0);">
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="archivo" id="archivo" />
                        <input type="submit" id="boton_subir" value="Subir" class="btn btn-success" />
                        <progress id="barra_de_progreso" value="0" max="100"></progress>
                    </div>
                </div>
            </form>      
      </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-6">
      
            <table class="table table-striped">
                <tr class="danger">
                    <td>Titulo</td>
                    <td>Texto</td>
                    <td>Video</td>
                    <td>Eliminar</td>
                </tr>
                <?=$tabla;?>
            </table>
      
      </div>
    </div>
    </body>
</html>
