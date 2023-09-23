<?php
class Producto{

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

    public function __construct(){
        $this->db = DataBase::connect();
    }



// getter and setters
    public function getId() {
      return $this->id;
    }
    public function setId($value) {
      $this->id = $this->db->real_escape_string($value);
    }

    public function getCategoria_id() {
      return $this->categoria_id;
    }
    public function setCategoria_id($value) {
      $this->categoria_id = $this->db->real_escape_string($value);
    }

    public function getNombre() {
      return $this->nombre;
    }
    public function setNombre($value) {
      $this->nombre = $this->db->real_escape_string($value);
    }

    public function getDescripcion() {
      return $this->descripcion;
    }
    public function setDescripcion($value) {
      $this->descripcion = $this->db->real_escape_string($value);
    }

    public function getPrecio() {
      return $this->precio;
    }
    public function setPrecio($value) {
      $this->precio = $this->db->real_escape_string($value);
    }

    public function getStock() {
      return $this->stock;
    }
    public function setStock($value) {
      $this->stock = $this->db->real_escape_string($value);
    }

    public function getOferta() {
      return $this->oferta;
    }
    public function setOferta($value) {
      $this->oferta = $this->db->real_escape_string($value);
    }

    public function getFecha() {
      return $this->fecha;
    }
    public function setFecha($value) {
      $this->fecha = $value;
    }

    public function getImagen() {
      return $this->imagen;
    }
    public function setImagen($value) {
      $this->imagen = $value;
    }

    public function getAll(){
        $sql = "SELECT * FROM productos;";
        $consulta = $this->db->query($sql);

        return $consulta;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre AS 'catNombre' FROM productos p "
        . "INNER JOIN categorias c ON c.id = p.categoria_id" 
        . " WHERE p.categoria_id = {$this->getCategoria_id()}" 
        . " ORDER BY id DESC";

        //  echo $sql;
        //  echo "<br>";
        //  echo $this->db->error;
        //  die();

        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getOne(){
        $sql = "SELECT * FROM productos WHERE id = {$this->getId()};";
        $consulta = $this->db->query($sql);

        return $consulta->fetch_object();
    }

    public function getRandom($limit){
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $productos = $this->db->query($sql);

        return $productos;

    }

    public function save(){
        $sql = "INSERT INTO productos VALUES (null, {$this->getCategoria_id()}, '{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";
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
      $sql ="DELETE FROM productos WHERE id={$this->id}";
      $delete = $this->db->query($sql);

      $result = false;
      if($delete){
        $result = true;
      }

      return $result;
    }

    public function edit(){
      $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion ='{$this->getDescripcion()}', precio={$this->getPrecio()},stock={$this->getStock()},  Categoria_id={$this->getCategoria_id()} ";
       
      if($this->getImagen() != null){
          $sql .= ", imagen ='{$this->getImagen()}'";
        }

      $sql .=" WHERE id={$this->id};";

      $save = $this->db->query($sql);

      $result = false;
      if($save){
        $result = true;
      }

      return $result;


    }
}