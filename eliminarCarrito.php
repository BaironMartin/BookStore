<?php

session_start();
$id=$_GET['id'];

if(!isset($_GET['id']) && !is_numeric($_GET['id'])){
    header('location:carrito.php');
}

if(isset($_SESSION['carrito'])){
    unset($_SESSION['carrito'][$id]);
    header('location:carrito.php');
}
else{
    header('location:index.php');
}


print_r($id);

?>