<?php

class Producto {

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getAllCategory() {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                . "AND p.stock > 0 "
                . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllSubCategory($idSubCategoria, $nombreCategoria) {
        $sql = "SELECT *, c.nombre AS 'catnombre', sb.nombre AS 'subcatnombre' "
                . "FROM productos p, {$nombreCategoria} n, subcategorias sb, categorias c "
                . "WHERE n.producto_id = p.id "
                . "AND sb.id = n.subcategoria_id "
                . "AND n.subcategoria_id = {$idSubCategoria} "
                . "AND p.categoria_id = c.id "
                . "GROUP BY p.id";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllCategoryLimit($empieza_aqui, $numero_elementos_pagina) {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} "
                . "AND p.stock > 0 "
                . "ORDER BY id DESC "
                . "LIMIT {$empieza_aqui} , {$numero_elementos_pagina}";
        $productosLimit = $this->db->query($sql);
        return $productosLimit;
    }

    public function getAllCategoryLimitBySubcategory($nombreCategoria, $idSubCategoria, $empieza_aqui, $numero_elementos_pagina) {
        $sql = "SELECT n.*, p.*, sc.nombre AS 'subcatnombre' FROM {$nombreCategoria} n "
                . "INNER JOIN subcategorias sc ON sc.id = n.subcategoria_id "
                . "INNER JOIN productos p ON n.producto_id = p.id "
                . "WHERE n.subcategoria_id = {$idSubCategoria} "
                . "AND p.stock > 0 "
                . "ORDER BY p.id DESC "
                . "LIMIT {$empieza_aqui} , {$numero_elementos_pagina}";
        $productosLimit = $this->db->query($sql);
        return $productosLimit;
    }

    public function getRandom($limit) {
        $productos = $this->db->query("SELECT * FROM productos WHERE stock > 0 ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getOne() {
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }

    public function findTable($table) {
        $find = $this->db->query("SELECT * FROM {$table} n, productos p WHERE p.id = {$this->getId()} AND p.id = n.producto_id GROUP BY p.id");
        return $find;
    }

    public function save() {
        $sql = "INSERT INTO productos VALUES(NULL, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getPrecio()}', '{$this->getStock()}', null, CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()} ";

        if ($this->getImagen() != null) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id={$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function downStock() {
        $sql = "UPDATE productos SET stock={$this->getStock()}";
        $sql .= " WHERE id={$this->id};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

}
