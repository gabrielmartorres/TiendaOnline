<?php

class Categoria {

    private $id;
    private $nombre;
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

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC");
        return $categorias;
    }
    
    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
        return $categoria->fetch_object();
    }


    public function save(){
        $sql= "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
         
        $result = false;
        if($save){
            $result=true;
        }
        return $result;
    }
    
    public function createTableCategory($table, $name, $arrayCampos){
        
        $sql="CREATE TABLE `{$table}` (
	`id{$name}` INT(11) NOT NULL AUTO_INCREMENT,
	`producto_id` INT(255) NOT NULL,
	`subcategoria_id` INT(11) NOT NULL, ";
        
        for($i=0;$i<sizeof($arrayCampos);$i++){
            $campo = $arrayCampos[$i]['campo'];
            $tipo = $arrayCampos[$i]['tipo'];
            $tam = $arrayCampos[$i]['tam'];
            $sql.= "\n`$campo` $tipo($tam) NOT NULL, \n";
        }
        
	$sql.="PRIMARY KEY (`id{$name}`),
	INDEX `FK_{$table}_productos` (`producto_id`),
	INDEX `FK_{$table}_subcategorias` (`subcategoria_id`),
	CONSTRAINT `FK_{$table}_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
	CONSTRAINT `FK_{$table}_subcategorias` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;";
      //var_dump($sql);die();  
      
      

//        $sql2="CREATE TABLE `{$table}` (
//	`id{$name}` INT(11) NOT NULL AUTO_INCREMENT,
//	`producto_id` INT(255) NOT NULL,
//	`subcategoria_id` INT(11) NOT NULL,
//	`tejidoExteriorAbrigo` VARCHAR(50) NOT NULL,
//	`forroAbrigo` VARCHAR(50) NOT NULL,
//	`tipoAbrigo` VARCHAR(50) NOT NULL,
//	`tallaAbrigo` VARCHAR(50) NOT NULL,
//	`colorAbrigo` VARCHAR(50) NOT NULL,
//	PRIMARY KEY (`idAbrigo`),
//	INDEX `FK_{$table}_productos` (`producto_id`),
//	INDEX `FK_{$table}_subcategorias` (`subcategoria_id`),
//	CONSTRAINT `FK_{$table}_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
//	CONSTRAINT `FK_{$table}_subcategorias` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id`)
//)
//COLLATE='latin1_swedish_ci'
//ENGINE=InnoDB
//AUTO_INCREMENT=1
//;";
        
        $save = $this->db->query($sql);
        return $save;
        //var_dump($sql,$this->db->error);die();  
        
    }

}