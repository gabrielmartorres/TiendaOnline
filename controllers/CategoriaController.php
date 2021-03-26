<?php

require_once 'models/categoria.php';
require_once 'models/subCategoria.php';
require_once 'models/producto.php';
require_once 'vendor/autoload.php';

class categoriaController {

    public function index() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function ver() {
        if ($_GET['id']) {
            $id = $_GET['id'];

            //Conseguir categoría
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            //Comprobar si el producto tiene subcategoria
            $idCategoria = $categoria->id;
            $subCategoria = new SubCategoria();
            $subCategoria->setCategoria_id($idCategoria);

            //Consigo las subcategorias si las tuviera
            $subCategorias = $subCategoria->getAllByCategory();
            $mostrarSubcategoria = false;
            if ($subCategorias->num_rows > 0) {
                //Si tiene subcategorias las muestro
                $mostrarSubcategoria = true;
                //require_once 'views/subcategoria/ver.php';
                require_once 'views/categoria/ver.php';
            } else {
                //Si no tiene subcategorías muestro los productos
                //Conseguir productos
                $producto = new Producto();
                $producto->setCategoria_id($id);
                $productos = $producto->getAllCategory();

                //Configuro la paginación
                //Obtengo el número de productos
                $numero_elementos = $productos->num_rows;
                //Número de elementos por página
                $numero_elementos_pagina = 3;
                //Hacer paginación
                $pagination = new Zebra_Pagination();
                //Número total de elementos a páginar
                $pagination->records($numero_elementos);
                //Número de elementos por páginas
                $pagination->records_per_page($numero_elementos_pagina);
                //Obtengo la página actual de la url
                $page = $pagination->get_page();
                $empieza_aqui = (($page - 1) * $numero_elementos_pagina);
                $productos = $producto->getAllCategoryLimit($empieza_aqui, $numero_elementos_pagina);

                require_once 'views/categoria/ver.php';
            }
        }
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['numCampos']) && isset($_POST['nombre'])) {
            if ($_POST['numCampos'] == 0) {
                //Es solo una categoría
                // Guardar la categoría en la bd
                $categoria = new Categoria();
                $categoria->setNombre($_POST['nombre']);
                $categoria->save();
            } else {
                //Lleva categoría y subcategoría
                //Obtener los datos para crear la tabla
                $numCampos = $_POST['numCampos'];

                $arrayCampos;

                for ($i = 0; $i < $numCampos; $i++) {
                    $indiceAumentado = $i + 1;
                    $favcolor = "red";
                    $tipo = $_POST['camposelect' . $indiceAumentado];

                    switch ($tipo) {
                        case "INT":
                            $tam = 11;
                            break;
                        case "VARCHAR":
                            $tam = 50;
                            break;
                        case "FLOAT":
                            $tam = "100,2";
                            break;
                    }
                    $arrayCampo = ["campo" => $_POST['campo' . $indiceAumentado], "tipo" => $_POST['camposelect' . $indiceAumentado], "tam" => $tam];
                    $arrayCampos[$i] = $arrayCampo;
                }

                $name = ucfirst($_POST['nombre']);
                $table = strtolower($name);

                $ObjCategoria = new Categoria();
                $save = $ObjCategoria->createTableCategory($table, $name, $arrayCampos); //'abrigos','Abrigo'
                
//                if($save){
//                    var_dump($save);die();  
//                }else{
//                    var_dump($save);die();
//                }
                
                // Guardar la categoría en la bd
                $categoria = new Categoria();
                $categoria->setNombre($_POST['nombre']);
                $categoria->save();
            }
        }
        header("Location: " . base_url . "categoria/index");
    }

}
