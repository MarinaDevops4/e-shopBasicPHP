<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController
{
    public function index()
    {
        Utils::isAdmin(); //comprobamos si es admin 
        $categoria = new Categoria();
        $categorias =  $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //CONSEGUIR CATEGORIA
            $categoria = new Categoria();
            $categoria->setId($id);

            $cat = $categoria->getOne();
            // var_dump($cat);

            //CONSEGUIR PRODUCTOS
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos =  $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }

    public function crear()
    {
        Utils::isAdmin(); //comprobamos si es admin 
        require_once 'views/categoria/crear.php';
    }

    public function save()
    {
        Utils::isAdmin(); //comprobamos si es admin 

        // comprobar si me llegan datos por POST y si ya existe el nombre de la categoria en la BBDD
        if (isset($_POST) && isset($_POST['nombre'])) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            
            $existeCategoria = $categoria->existeCategoria($nombre);
           
            if ($existeCategoria) {
                $_SESSION['existeCategoria'] = true;
                echo "El registro no puede realizarse";
              
            } else {
                $_SESSION['existeCategoria'] = false;
                echo "El registro puede realizarse";
                // guardar la categoria
                $categoria->setNombre($_POST['nombre']);
                $save = $categoria->save();
            }

            // $_SESSION['existeCategoria'] = true;
        }

        header("Location:" . base_url . "categoria/index");
    }
}
