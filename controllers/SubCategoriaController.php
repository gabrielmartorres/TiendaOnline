<?php

require_once 'models/categoria.php';
require_once 'models/subCategoria.php';
require_once 'models/producto.php';
require_once 'vendor/autoload.php';

class subCategoriaController {

    public function index() {
        Utils::isAdmin();
        $subCategoria = new SubCategoria();
        $subCategorias = $subCategoria->getAll();

        require_once 'views/subcategoria/index.php';
    }

    public function ver() {
        if ($_GET['id']) {
            $id = $_GET['id'];

            //Conseguir subcategoría
            $subcategoria = new SubCategoria();
            $subcategoria->setId($id);
            $subcategoria = $subcategoria->getOne();

            //Conseguir categoría
            $categoria = new categoria();
            $categoria->setId($subcategoria->categoria_id);
            $categoria = $categoria->getOne();

            //Guardo el nombre de la categoría en minúsculas
            $nombreCategoria = strtolower($categoria->nombre);

            //Guardo la id de la categoría y de subcategoria
            $idSubCategoria = $subcategoria->id;
            $idCategoria = $categoria->id;

            //Conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($idCategoria);
            $productos = $producto->getAllSubCategory($idSubCategoria, $nombreCategoria);

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
            $productos = $producto->getAllCategoryLimitBySubcategory($nombreCategoria, $idSubCategoria, $empieza_aqui, $numero_elementos_pagina);


            require_once 'views/subcategoria/ver.php';
        }
    }

    public function crear() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/subcategoria/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['nombre']) && isset($_POST['categoria'])) {
            // Guardar la categoría en la bd
            $subcategoria = new SubCategoria();
            $subcategoria->setCategoria_id($_POST['categoria']);
            $subcategoria->setNombre($_POST['nombre']);

            // Guardar la imagen
            if (isset($_FILES['imagen'])) {
                $file = $_FILES['imagen'];
                $file_name = $file['name'];
                $mimetype = $file['type'];


                if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/git') {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    $subcategoria->setImagen($file_name);

                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $file_name);
                }
            }

            $subcategoria->save();

            //header("Location:" . base_url . "subcategoria/index");
            echo"<h1>Subcategoría creada</h1>";
            echo"<p>La subcategoría " . $subcategoria->getNombre() . " ha sido creada.</p><br>";
            echo"<a href='" . base_url . "subcategoria/index'>Ver listado de subcategorías</a>";
        } else {
            header("Location:" . base_url . "subcategoria/index");
        }
    }

}
