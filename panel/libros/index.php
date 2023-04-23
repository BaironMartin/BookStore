<?php
session_start();
if(!isset($_SESSION['user'] ) || empty($_SESSION['user'])){
    header("location:../index.php");
}?>
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
                        <a href="index" class="btn ">LIBROS </a>
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
                <div class="pull-right">
                    <a class="btn btn-primary" href="form_registrar.php"><span class="glyphicon glyphicon-plus">&nbsp</span>Nuevo</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend>Listado de Libros</legend>
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Num</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Foto</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../../vendor/autoload.php';
                            $libro = new bookstore\Libros;
                            $inf_libro = $libro->mostrar();
                            $cantidad = count($inf_libro);
                            
                            if ($cantidad > 0) {
                                $c=0;
                                for($x =0; $x<$cantidad; $x++){
                                    $c++;
                                    $item =  $inf_libro[$x];
                            ?>
                                <tr>
                                    <td scope="col"><?php print $c?></td>
                                    <td scope="col"><?php print $item['titulo']?></td>
                                    <td scope="col"><?php print $item['nombre']?></td>
                                    <td scope="col"><?php print $item['precio']?> $</td>
                                    <td scope="col">
                                        <?php
                                        $foto='../../upload/'.$item['foto'];
                                        if (file_exists($foto)){
                                            ?>
                                            
                                            <img src='<?php print $foto;?>' width="50px">
                                            <?php
                                        }else{
                                            ?>
                                            <img src='../../assets/imagenes/vacia.png' width="50px">
                                            <?php
                                        }
                                        ?>

                                    </td>
                                    <td scope="col">
                                        <a class="btn btn-danger  btn-small" href="../acciones.php?id=<?php print $item['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a class="btn btn-success btn-small" href="form_actualizar.php?id=<?php print $item['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                </tr>

                            <?php
                            }
                            } else {

                            ?>
                                <td colspan="6" scope="col">No hay Registros</td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>

</html>