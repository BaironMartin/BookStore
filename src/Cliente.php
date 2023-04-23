<?php

namespace bookstore;

class Cliente
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

    public function registrar($_params)    {
        $sql = "INSERT INTO`clientes`( `nombres`, `apellidos`, `mail`, `telefono`, `comentario`)
            VALUES (:nombres, :apellidos, :mail, :telefono, :comentario)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombres" => $_params['nombres'],
            ":apellidos" => $_params['apellidos'],
            ":mail" => $_params['mail'],
            ":telefono" => $_params['telefono'],
            ":comentario" => $_params['comentario']
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

}