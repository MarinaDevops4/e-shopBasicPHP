<?php
require_once 'models/producto.php';
class productoController
{
    public function index()
    {
           $producto = new Producto();
           $productos = $producto->getRandom(9);
        
           
        //    renderizar vista
        require_once 'views/producto/destacados.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            //variables
          
            $id = $_GET['id'];
            //instanciar objeto
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/ver.php';

        }
    }

    public function gestion()
    {
        Utils::isAdmin(); // comprobamos si es administrador
        $producto = new Producto();
        $productos = $producto->getAll();


        require_once('views/producto/gestion.php');
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ?  $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            // $imagen= isset($_POST['imagen'])? $_POST['imagen'] :false;

            if ($nombre &&  $descripcion && $precio &&  $stock &&  $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                // GUARDAR IMAGEN | (repasa que el form está formateado para subir imgs)
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $fileName = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                        // var_dump($file);
                        // die();
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($fileName);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $fileName);
                    }
                }

                if(isset($_GET['id'])){
                    $id=$_GET['id'];

                    $producto->setId($id);

                    $save = $producto->edit();

                }else{

                    $save = $producto->save();
                }



                if ($save = true) {
                    $_SESSION['producto'] = true;
                } else {
                    $_SESSION['producto'] = false;
                }
            } else {
                $_SESSION['producto'] = false;
            }
        } else {
            $_SESSION['producto'] = false;
        }
        header("Location:" . base_url . "producto/gestion");
    }

    public function editar()
    {
        Utils::isAdmin(); //comprobamos admin
        if(isset($_GET['id'])){
            //variables
            $edit = true;
            $id = $_GET['id'];

            //instanciar objeto
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';

        }else{

            header("Location:" . base_url . "producto/gestion");
        }

    }
    public function eliminar()
    {
        Utils::isAdmin(); //comprobamos si es Administrador
        if (isset($_GET['id'])) {
           
            $id= $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['eliminar'] = true;
            } else {
                $_SESSION['eliminar'] = false;
            }
        } else {
            $_SESSION['eliminar'] = false;
        }

        header("Location:".base_url."producto/gestion");
    }
}
