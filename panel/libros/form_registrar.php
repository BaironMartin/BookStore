<?php
session_start();
if(!isset($_SESSION['user'] ) || empty($_SESSION['user'])){
    header("location:../index.php");
}
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
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
                <a class="navbar-brand" href="../dashboard.php">Book Store</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="../pedidos/index.php" class="btn ">PEDIDOS </a>
                    </li>
                    <li class="active">
                        <a href="index.php" class="btn ">LIBROS </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['user']['user']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../cerrar_seccion.php">Salir</a></li>
                            <li><a href="../dashboard.php">Panel</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->

        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Datos del libro</legend>

                    <form action="../acciones.php" method="POST" enctype="multipart/form-data" class="">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Titulo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="titulo" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion</label>
                            <textarea class="ckeditor" id="ckeditor" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Categoria</label>
                            <select name="categoriaid" class="form-control" id="exampleFormControlSelect1" required>
                                <option>--Seleccione una opcion--</option>
                                
                                <?php
                                require '../../vendor/autoload.php';
                                $categoria = new bookstore\Categoria;
                                $info_categoria = $categoria->mostrar();
                                $cantidad = count($info_categoria);
                                for ($x = 0; $x < $cantidad; $x++) {
                                    $item = $info_categoria[$x];
                                ?>
                                    <option value="<?php print $item['id'] ?>"><?php print $item['nombre'] ?></option>
                                <?php

                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Imagen</label>
                            <input name="foto" type="file" class="form-control-file" id="exampleFormControlFile1" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Precio</label>
                            <input type="number" class="form-control" id="formGroupExampleInput" name="precio" required>
                        </div>
                        <div class="container center-align">
                            <input type="submit" name="action" class="btn btn-success " value="Registrar">
                            <a class="btn btn-danger " href="index.php">Cancelar</a>
                        </div>

                    </form>
                </fieldset>
            </div>
        </div>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>

</body>

</html>