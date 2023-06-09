<?php

session_start();

require 'funciones.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    require 'vendor/autoload.php';
    $libro = new bookstore\Libros;
    $resultado = $libro->mostrarporid($id);

    if (!$resultado) {
        header('location:index.php');
    }



    if (isset($_SESSION['carrito'])) { //carrito existe
        if (array_key_exists($id, $_SESSION['carrito'])) { //libro existe en el arrito
            actualizarLibro($id);
            header('location:carrito.php');
            
        } else {
            agregarLibro($resultado, $id);
            header('location:carrito.php');
        }
    } else { //si carrito no eciste
        agregarLibro($resultado, $id);
        header('location:carrito.php');
    }
} 



require 'vendor/autoload.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BookStore</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top ">
        <div class="container">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Kawschool Store</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="carrito.php" class="btn ">CARRITO <span class="badge"><?php print cantidadLibros(); ?></span></a>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container" id="main">
    <div class="row">
            <div class="jumbotron">
                <p>Gracias por su compra</p>
                <p>
                    <a href="index.php">Regresar</a>
                </p>
            </div>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>