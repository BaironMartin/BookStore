<?php

namespace bookstore;

class Pedido
{
    private $config;
    private $cn = null;

    public function __construct()
    {

        $this->config  = parse_ini_file(__DIR__ . '/../config.ini');

        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SEt NAMES utf8'
        ));
    }

    public function registrar($_params)
    {
        $sql = "INSERT INTO`pedidos`( `clienteid`, `total`, `fecha`)
            VALUES (:clienteid, :total, :fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":clienteid" => $_params['clienteId'],
            ":total" => $_params['total'],
            ":fecha" => $_params['fecha']

        );


        if ($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

    public function registrarDetallle($_params)
    {
        $sql = "INSERT INTO `detallepedidos`(`pedidoid`, `peliculaid`, `precio`, `cantidad`)
            VALUES (:pedidoid, :peliculaid, :precio, :cantidad )";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":pedidoid" => $_params['pedidoid'],
            ":peliculaid" => $_params['peliculaid'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad']

        );

        if ($resultado->execute($_array))
            return  true;

        return false;
    }

    public function mostrar()
    {
        $sql = "SELECT p.id, nombres, apellidos ,mail , total, fecha, telefono FROM pedidos p
        INNER JOIN clientes c ON p.clienteid = c.id ORDER BY p.id DESC";
        $resultado = $this->cn->prepare($sql);
        if ($resultado->execute())
            return $resultado ->fetchAll();

        return false;
    }

    public function mostrarId($id)
    {
        $sql = "SELECT p.id, nombres, apellidos ,mail , total, fecha, telefono FROM pedidos p
        INNER JOIN clientes c ON p.clienteid = c.id WHERE P.id = :id";
        $resultado = $this->cn->prepare($sql);

        $_array= array(
            ':id' => $id
        );
        if ($resultado->execute($_array))
            return $resultado ->fetch();

        return false;
    }

    public function mostrarDetalleId($id)
    {
        $sql = "SELECT 
        dp.id,
        li.titulo,
        dp.precio,
        dp.cantidad,
        li.foto FROM detallepedidos  dp INNER JOIN libros li ON li.id = dp.peliculaid Where dp.pedidoid= :id ORDER BY li.id DESC";
        $resultado = $this->cn->prepare($sql);

        $_array= array(
            ':id' => $id
        );
        if ($resultado->execute($_array))
            return $resultado ->fetchAll();

        return false;
    }
    public function mostrarUltimos()
    {
        $sql = "SELECT p.id, nombres, apellidos ,mail , total, fecha, telefono FROM pedidos p
        INNER JOIN clientes c ON p.clienteid = c.id ORDER BY p.id DESC LIMIT 10";
        $resultado = $this->cn->prepare($sql);
        if ($resultado->execute())
            return $resultado ->fetchAll();

        return false;
    }
}
