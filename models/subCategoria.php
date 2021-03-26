<?php

class SubCategoria extends Categoria{

    private $id;
    private $nombre;
    private $categoria_id;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }
            
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }
      
    function getImagen() {
        return $this->imagen;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function getAll(){
        $subcategorias = $this->db->query("SELECT sc.id AS 'idSubcategoria', sc.nombre AS 'nombreSubcategoria', c.id AS 'idCategoria', c.nombre AS 'nombreCategoria' "
                . "FROM subcategorias sc, categorias c "
                . "WHERE sc.categoria_id = c.id "
                . "ORDER BY sc.id DESC");
//        $subcategorias = $this->db->query("SELECT * FROM subcategorias ORDER BY id DESC");
        return $subcategorias;
    }
    
    public function getAllByCategory(){
        $subcategorias = $this->db->query("SELECT * FROM subcategorias WHERE categoria_id = {$this->getCategoria_id()} ORDER BY id DESC");
        return $subcategorias;
    }
    
    public function getOne(){
        $subcategorias = $this->db->query("SELECT * FROM subcategorias WHERE id={$this->getId()}");
        return $subcategorias->fetch_object();
    }


    public function save(){
        $sql= "INSERT INTO subcategorias VALUES(NULL, '{$this->getNombre()}', {$this->getCategoria_id()}, '{$this->getImagen()}');";
        $save = $this->db->query($sql);
         
        $result = false;
        if($save){
            $result=true;
        }
        return $result;
    }

}