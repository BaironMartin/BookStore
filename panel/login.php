<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pas = $_POST['pass'];


    require '../vendor/autoload.php';
    $Usuario = new bookstore\Usuario;
    $resultado = $Usuario->login($email, $pas);

    if ($resultado) {
        $_SESSION['user']= array(
            'user'=>$resultado['nombreuser'],
            'estado' =>1
        );
        header('location:dashboard.php');
    } else {
        exit(json_encode(array('estado' => FALSE, 'mensaje' => 'ERROR AL INICIAR SESION')));
    };
}
