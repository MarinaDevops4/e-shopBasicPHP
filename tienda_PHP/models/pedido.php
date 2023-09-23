<?php
class Pedido{

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }
// GETTER Y SETTERS
public function getId() {
    return $this->id;
  }
  public function setId($value) {
    $this->id = $value;
  }

  public function getUsuario_id() {
    return $this->usuario_id;
  }
  public function setUsuario_id($value) {
    $this->usuario_id = $value;
  }

  public function getProvincia() {
    return $this->provincia;
  }
  public function setProvincia($value) {
    $this->provincia = $this->db->real_escape_string($value);
  }

  public function getLocalidad() {
    return $this->localidad;
  }
  public function setLocalidad($value) {
    $this->localidad =$this->db->real_escape_string($value);
  }

  public function getDireccion() {
    return $this->direccion;
  }
  public function setDireccion($value) {
    $this->direccion = $this->db->real_escape_string($value);
  }

  public function getCoste() {
    return $this->coste;
  }
  public function setCoste($value) {
    $this->coste = $value;
  }

  public function getEstado() {
    return $this->estado;
  }
  public function setEstado($value) {
    $this->estado = $value;
  }

  public function getFecha() {
    return $this->fecha;
  }
  public function setFecha($value) {
    $this->fecha = $value;
  }

  public function getHora() {
    return $this->hora;
  }
  public function setHora($value) {
    $this->hora = $value;
  }

//   END GETTER Y SETTERS

    

    public function getAll(){
        $sql = "SELECT * FROM pedidos;";
        $consulta = $this->db->query($sql);

        return $consulta;
    }
    public function getOne(){
      $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
      $pedido = $this->db->query($sql);

      return $pedido->fetch_object();
  }

    public function getAllCategory(){
        $sql = "SELECT p.*, u.nombre AS 'UsuarioId' FROM pedidos p "
        . "INNER JOIN usuarios u ON u.id = p.usuario_id" 
        . " WHERE p.usuario_id = {$this->getUsuario_id()}" 
        . " ORDER BY id DESC";

        //  echo $sql;
        //  echo "<br>";
        //  echo $this->db->error;
        //  die();

        $pedidos = $this->db->query($sql);

        return $pedidos;
    }

    public function getAllByUser(){
        $sql = "SELECT * FROM pedidos p WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC;";
        $pedido = $this->db->query($sql);
        
                // echo $sql;
                // echo $this->db->error;
                // die();

        return $pedido;
    }

    public function getOneByUser(){
      $sql = "SELECT p.id, p.coste FROM pedidos p WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";
      
      $pedido = $this->db->query($sql);
      
              // echo $sql;
              // echo $this->db->error;
              // die();

      return $pedido->fetch_object();
  }

    public function getProductsByPedido($id){

        // $sql = "SELECT * FROM productos WHERE id IN
        //  (SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id});";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id
        WHERE lp.pedido_id={$id}";
        
        $productos = $this->db->query($sql);
        return $productos;

    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES (null, {$this->getUsuario_id()}, '{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save =  $this->db->query($sql);

        // DEPURACION POR ERROR
        // echo $sql;
        // echo "<br>";
        // echo $this->db->error;
        // die();

        $result = false;

        if($save){
          $result = true;
        }

        return $result;
    }

    public function delete(){
      $sql ="DELETE FROM pedidos WHERE id={$this->id}";
      $delete = $this->db->query($sql);

      $result = false;
      if($delete){
        $result = true;
      }

      return $result;
    }

// GUARDAMOS LINEA DE PEDIDOS 
    public function save_linea(){
        
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $save =  $this->db->query($sql);

        $pedido_id = $save->fetch_object()->pedido;

      foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
            $save = $this->db->query($insert);  

           
        
      }

      $result = false;

      if($save){
        $result = true;
      }

      return $result;

        

    }

  public function edit()
  {
    $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' WHERE id = {$this->getId()} ";
    $save = $this->db->query($sql);

    $result = false;
    if($save){
      $result = true;
    }

    return $result;

  }
    
}