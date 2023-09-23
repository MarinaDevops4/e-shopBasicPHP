<?php
class Categoria
{
    private $id;
    private $nombre;

    // CONEXION DB
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll()
    {   $sql = "SELECT * FROM categorias ORDER BY id DESC;";
        $categorias = $this->db->query($sql);

        
        return $categorias;
    }

    public function getOne()
    {   $sql = "SELECT * FROM categorias WHERE id = {$this->getId()};";
        $categorias = $this->db->query($sql);

        
        return $categorias->fetch_object();
    }


    public function existeCategoria($nombre){
        $sql ="SELECT * FROM categorias where nombre ='$nombre'";
        $consulta = $this->db->query($sql);

        if ($consulta->num_rows > 0) {
            return true;
        }else{
            return false;
        }

    }


    public function save(){
        
        $sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}')";
        $save =  $this->db->query($sql);

        // comprobamos si se ha guardado correctamente
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}
