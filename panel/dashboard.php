<?php
session_start();
if(!isset($_SESSION['user'] ) || empty($_SESSION['user'])){
    header("location:index.php");
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
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
                <a class="navbar-brand" href="dashboard.php">Book Store</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="pedidos/index.php" class="btn ">PEDIDOS </a>
                    </li>
                    <li>
                        <a href="libros/index.php" class="btn ">LIBROS </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['user']['user']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="cerrar_seccion.php">Salir</a></li>
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
                    <legend>Ultimos Pedidos</legend>
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Num Pedido</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Total</th>
                                <th scope="col">Fecha</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../vendor/autoload.php';
                            $pedido = new bookstore\Pedido;
                            $inf_pedido = $pedido->mostrarUltimos();
                            $cantidad = count($inf_pedido);

                            if ($cantidad > 0) {
                                $c = 0;
                                for ($x = 0; $x < $cantidad; $x++) {
                                    $item =  $inf_pedido[$x];
                            ?>
                                    <tr>
                                        <td scope="col"><?php print $item['id'] ?></td>
                                        <td scope="col"><?php print $item['nombres'] ?></td>
                                        <td scope="col"><?php print $item['apellidos'] ?></td>
                                        <td scope="col"><?php print $item['mail'] ?> </td>
                                        <td scope="col"><?php print $item['telefono'] ?></td>
                                        <td scope="col"><?php print $item['total'] ?>$</td>
                                        <td scope="col"><?php print $item['fecha'] ?></td>
                                        <td scope="col">
                                            <a class="btn btn-success btn-small" href="pedidos/ver.php?id=<?php print $item['id'] ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>