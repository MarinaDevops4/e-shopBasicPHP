<?php
require_once 'models/pedido.php';
class pedidoController
{

    public function index()
    {
        require_once 'views/pedido/index.php';
    }
    public function add()
    {
        // var_dump($_POST);
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            if ($provincia && $localidad && $direccion) {


                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                   // GUARDAR LINEA PEDIDO
                   $save_line = $pedido->save_linea();

                if ($save && $save_line) {
                    $_SESSION['pedido'] = true;
                } else {
                    $_SESSION['pedido'] = false;
                }
            } else {
                $_SESSION['pedido'] = false;
            }

                header("Location:" . base_url. "pedido/confirmado");
        } else {
            header("Location:" . base_url);
        }
    }


    public function confirmado(){
        if(isset($_SESSION['identity'])){
        $identity = $_SESSION['identity'];

        $pedido = new Pedido();
        $pedido->setUsuario_id($identity->id);
        $pedido =  $pedido->getOneByUser();

        $pedido_productos = new Pedido();
        $productos = $pedido_productos->getProductsByPedido($pedido->id);

        }

        require_once 'views/pedido/confirmado.php';
    }


    public function mis_pedidos(){
            Utils::isIdentity();
        
        $usuario_id = $_SESSION['identity']->id; //id del usuario

        // sacar los pedidos del usuario
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();
        if(isset($_GET['id'])){

            $id_pedido = $_GET['id'];

         // sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id_pedido);
            $pedido = $pedido->getOne();
        //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($id_pedido);

        }else{
            header("Location".base_url."pedido/mis_pedidos");
        }
        require_once 'views/pedido/detalle.php';
    }

    public function gestion(){
        utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }


    public function estado(){
        Utils::isAdmin();
        if( isset($_POST['pedido_id']) && isset($_POST['estado']) ){
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);

            $pedido->edit();
        
            header("Location:".base_url."pedido/detalle&id=".$id);
        }else{
            header("Location:".base_url);
        }
    }
}
