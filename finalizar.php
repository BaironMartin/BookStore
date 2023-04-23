<?php
session_start();
require "funciones.php";
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
        <div class="main-form">
            <div class="col-md-12">
                <fieldset>
                    <legend>Completar Datos</legend>
                    <form action="completarPedido.php" method="post" >
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nombre</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Apellido</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">E-Mail</label>
                            <input type="email" class="form-control" id="formGroupExampleInput" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Telefono</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Comentario</label>
                            <textarea  class="form-control" rows="4" name="comentario" ></textarea>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit">Enviar</button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>