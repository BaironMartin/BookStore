<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require "funciones.php";
    require 'vendor/autoload.php';

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new bookstore\Cliente;

        $_params = array(
            "nombres" => $_POST['nombre'],
            "apellidos" => $_POST['apellido'],
            "mail" => $_POST['mail'],
            "telefono" => $_POST['telefono'],
            "comentario" => $_POST['comentario']
        );

        
        $clienteId = $cliente->registrar($_params);

        $pedido = new bookstore\Pedido;

        $_params = array(
            "clienteId" => $clienteId,
            "total" => CalcularTotal(),
            "fecha" => date('Y-m-d'),
        );
        $pedido_id = $pedido->registrar($_params);

        foreach ($_SESSION['carrito'] as $indice => $value) {
            $_params = array(
                "pedidoid" => $pedido_id,
                "peliculaid" => $value['id'],
                "precio" => $value['precio'],
                "cantidad" => $value['cantidad']
            );
            $pedido -> registrarDetallle($_params);
        }
        $_SESSION['carrito']=array();
        header('Location:gracias.php');
    }
}
