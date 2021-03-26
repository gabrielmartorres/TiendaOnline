<?php

class Tela extends Producto{

    private $id;
    private $producto_id;
    private $subcategoria_id;
    private $anchoTela;
    private $altoTela;
    private $pesoTela;
    private $composicionTela;    
    private $tipoTejido;
    private $tipoColor;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getProducto_id() {
        return $this->producto_id;
    }
    
    function getSubcategoria_id() {
        return $this->subcategoria_id;
    }

    function getAnchoTela() {
        return $this->anchoTela;
    }

    function getAltoTela() {
        return $this->altoTela;
    }

    function getPesoTela() {
        return $this->pesoTela;
    }

    function getComposicionTela() {
        return $this->composicionTela;
    }    

    function getTipoTejido() {
        return $this->tipoTejido;
    }

    function getTipoColor() {
        return $this->tipoColor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProducto_id($producto_id) {
        $this->producto_id = $producto_id;
    }

    function setSubcategoria_id($subcategoria_id) {
        $this->subcategoria_id = $this->db->real_escape_string($subcategoria_id);
    }
    
    function setAnchoTela($anchoTela) {
        $this->anchoTela = $this->db->real_escape_string($anchoTela);
    }

    function setAltoTela($altoTela) {
        $this->altoTela = $this->db->real_escape_string($altoTela);
    }

    function setPesoTela($pesoTela) {
        $this->pesoTela = $this->db->real_escape_string($pesoTela);
    }

    function setComposicionTela($composicionTela) {
        $this->composicionTela = $this->db->real_escape_string($composicionTela);
    }
 
    function setTipoTejido($tipoTejido) {
        $this->tipoTejido = $this->db->real_escape_string($tipoTejido);
    }

    function setTipoColor($tipoColor) {
        $this->tipoColor = $this->db->real_escape_string($tipoColor);
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM productos p, telas t WHERE t.producto_id = p.id ORDER BY p.id DESC");
        return $productos;
    }
    
    public function getAllTypeTela() {
        $sql = "SELECT * FROM productos p "
                . "INNER JOIN telas t ON t.producto_id = p.id "
                . "WHERE t.subcategoria_id = {$this->getSubcategoria_id()} "
                . "AND p.stock > 0 "
                . "ORDER BY id DESC";

        $productos = $this->db->query($sql);
        return $productos;       
    }    
}
