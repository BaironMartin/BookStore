<?php

namespace bookstore;

class Libros
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
        $sql = "INSERT INTO `libros`(`titulo`, `descripcion`, `foto`, `precio`, `categoriaid`, `fecha`)
            VALUES (:titulo , :descripcion, :foto, :precio, :categoriaid, :fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":categoriaid" => $_params['categoriaid'],
            ":fecha" => $_params['fecha'],
        );

        if ($resultado->execute(($_array))) {
            return true;
        } else {
            return false;
        }
    }
    public function actualizar($_params)
    {

        $sql = "UPDATE `libros` SET `titulo`=:titulo,`descripcion`=:descripcion,
        `foto`=:foto,`precio`=:precio,`categoriaid`=:categoriaid,`fecha`=:fecha WHERE `id`= :id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":categoriaid" => $_params['categoriaid'],
            ":fecha" => $_params['fecha'],
            ":id" => $_params['id'],
        );

        if ($resultado->execute(($_array))) {
            return true;
        } else {
            return false;
        }
    }
    public function eliminar($id)
    {
        $sql = "DELETE FROM `libros` WHERE `id` = :id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id,
        );

        if ($resultado->execute(($_array))) {
            return true;
        } else {
            return false;
        }
    }
    public function mostrar()
    {

        $sql = "SELECT libros.id, titulo,descripcion, foto,nombre, precio,fecha, estado  FROM `libros`
                INNER JOIN categorias
                ON libros.categoriaid=categorias.id ORDER BY libros.id DESC";

        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute()) {
            return $resultado->fetchAll();
        } else {
            return false;
        }
    }
    public function mostrarporid($id)
    {
        $sql = "SELECT * FROM `libros`Where `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id,
        );

        if ($resultado->execute($_array)) {
            return $resultado->fetch();
        } else {
            return false;
        }
    }
}
