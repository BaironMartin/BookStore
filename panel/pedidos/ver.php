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
                    <li class="active">
                        <a href="index.php" class="btn ">PEDIDOS </a>
                    </li>
                    <li>
                        <a href="../libros/" class="btn ">LIBROS </a>
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

                    <?php
                    require '../../vendor/autoload.php';
                    $id = $_GET['id'];
                    $pedido = new bookstore\Pedido;
                    $info_Pedido = $pedido->mostrarId($id);
                    $info_DetallePedido = $pedido->mostrarDetalleId($id);

                    ?>
                    <legend>Informacion de la Compra</legend>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['nombres'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input type="text" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['apellidos'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">E-Mail</label>
                        <input type="email" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['mail'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['fecha'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Telefono</label>
                        <input type="text" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['telefono'] ?>">
                    </div>

                    <hr>
                    <fieldset>
                        <legend>Libros Adquiridos</legend>
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Num Pedido</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $cantidad = count($info_DetallePedido);

                                if ($cantidad > 0) {
                                    $final = 0;
                                    for ($x = 0; $x < $cantidad; $x++) {
                                        $item =  $info_DetallePedido[$x];
                                        $total = $item['precio'] * $item['cantidad'];
                                ?>
                                        <tr>
                                            <td scope="col"><?php print $item['id'] ?></td>
                                            <td scope="col"><?php print $item['titulo'] ?></td>
                                            <td scope="col">
                                                <?php
                                                $foto = '../../upload/' . $item['foto'];
                                                if (file_exists($foto)) {
                                                ?>

                                                    <img src='<?php print $foto; ?>' width="50px">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src='../../assets/imagenes/vacia.png' width="50px">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td scope="col"><?php print $item['precio'] ?>$</td>
                                            <td scope="col"><?php print $item['cantidad'] ?></td>
                                            <td scope="col"><?php print $total ?></td>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tolal</label>
                            <input type="text" name="" id="" class="form-control" readonly value="<?php print $info_Pedido['total'] ?>$">
                        </div>
                    </div>
                </fieldset>
                <div class="pull-left">
                <a href="index.php" class="btn btn-success hidden-print">Regresar</a>
                </div>
                <div class="pull-right">
                <a href="javascript:;" id="btnImprimir" class="btn btn-danger btn-block hidden-print">Imprimir</a>
                </div>

                
                
            </div>
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script>
        $('#btnImprimir').on ('click',function(){

            window.print();

            return false;

    })
    </script>

</body>

</html>