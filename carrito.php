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

        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">Num</th>
                    <th scope="col">Libro</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    $num =1;
                    foreach ($_SESSION['carrito'] as $indice => $value) {
                        $total = $value['precio'] * $value['cantidad'];
                ?>

                        <tr>
                            <form action="actualizaarCarrito.php" method="post">
                                <td><?php  print $num++;?></td>
                                <td><?php print $value['titulo'] ?></td>
                                <td><?php
                                    $foto = 'upload/' . $value['foto'];
                                    if (file_exists($foto)) {
                                    ?>

                                        <img src='<?php print $foto; ?>' width="50px">
                                    <?php
                                    } else {
                                    ?>
                                        <img src='assets/imagenes/vacia.png' width="50px">
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?php print $value['precio'] ?></td>
                                <td>
                                    <input value="<?php print $value['id'] ?>"  type="hidden" name="id" id="">

                                    <input value="<?php print $value['cantidad'] ?>" class="form-control u-zise-100" type="number" name="cantidad" id="">
                                </td>
                                <td><?php print $total ?>$</td>
                                <td>
                                    <button type="submit" class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-refresh"></span></button>

                                    <a class="btn btn-danger  btn-xs" href="eliminarCarrito.php?id=<?php print $value['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </form>
                        </tr>
                    <?php
                    }
                } else {

                    ?>
                    <tr>
                        <td colspan="7" scope="col">No hay Productos en el Carrito</td>
                    </tr>
                <?php

                }
                ?>
            </tbody>
            <tfoot>
                <td colspan="5" class="text-right">
                Total
                </td>
                <td colspan="2">
                <?php print CalcularTotal(); ?> $
                </td>
            </tfoot>
        </table>

        <hr>
<?php
if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
    ?>
<div class="row">
    <div class="pull-left">
        <a href="index.php" class="btn btn-info">Seguir Comprando</a>
    </div>
    <div class="pull-right">
    <a href="Finalizar.php" class="btn btn-success">Finalizar Compra</a>
    </div>
</div>
    <?php

}


?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>