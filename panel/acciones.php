<?php

date_default_timezone_set('America/Bogota');
require '../vendor/autoload.php';
$libros = new bookstore\Libros;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'Registrar') {
        if (empty($_POST['titulo'])) {
            exit("Completar Titulo");
        }
        if (empty($_POST['descripcion'])) {
            exit("Completar descripcion");
        }
        if (empty($_POST['precio'])) {
            exit("Completar precio");
        }
        if (empty($_POST['titulo'])) {
            exit("Completar Titulo");
        }
        if (empty($_POST['categoriaid'])) {
            exit("Completar categoria");
        }
        if (!is_numeric($_POST['categoriaid'])) {
            exit("Seleccionar una categoria valida");
        }

        $_params = array(
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'foto' => subirfoto(),
            'precio' => $_POST['precio'],
            'categoriaid' => $_POST['categoriaid'],
            'fecha' => date('Y-m-d')
        );

        $rpt = $libros->registrar($_params);

        if ($rpt) {
            header("location:libros/index.php");
        }
        else{
            print('Error al guardar un libro');
        }
    }


    if ($_POST['action'] === 'Modificar') {
    
        if (empty($_POST['titulo'])) {
            exit("Completar Titulo");
        }
        if (empty($_POST['descripcion'])) {
            exit("Completar descripcion");
        }
        if (empty($_POST['precio'])) {
            exit("Completar precio");
        }
        if (empty($_POST['titulo'])) {
            exit("Completar Titulo");
        }
        if (empty($_POST['categoriaid'])) {
            exit("Completar categoria");
        }
        if (!is_numeric($_POST['categoriaid'])) {
            exit("Seleccionar una categoria valida");
        }
    
        $_params = array(
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio'],
            'categoriaid' => $_POST['categoriaid'],
            'fecha' => date('Y-m-d'),
            'id' => $_POST["id"],
        );
    
        if(!empty($_POST['foto_temp'])){
            $_params['foto'] = $_POST['foto_temp'];
        }
        if(!empty($_FILES['foto']['name'])){
            $_params['foto'] = subirfoto();
        }
    
        $rpt = $libros->actualizar($_params);
    
        if ($rpt) {
            header("location:libros/index.php");
        }
        else{
            print('Error al Modificar un libro');
        }
    
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $id= $_GET['id'];
    $rpt = $libros->eliminar($id);

    if ($rpt) {
        header("location:libros/index.php");
    }
    else{
        print('Error eliminar');
    }

}





function subirfoto()
{
    $carpeta = __DIR__ . '/../upload/';
    $archivo = $carpeta . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
    return $_FILES['foto']['name'];
}
