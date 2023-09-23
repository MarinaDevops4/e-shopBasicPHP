<?php

class Usuario
{

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    // CONEXION DB
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }


    // GETTER & SETTERS
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    // vamos a escapar los datos en los setters con real_escape_string
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($value)
    {
        $this->nombre = $this->db->real_escape_string($value);
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function setApellidos($value)
    {
        $this->apellidos = $this->db->real_escape_string($value);
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $this->db->real_escape_string($value);
    }
    // guardamos la contraseña como hash
    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);;
    }
    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getRol()
    {
        return $this->rol;
    }
    public function setRol($value)
    {
        $this->rol = $value;
    }

    public function getImagen()
    {
        return $this->imagen;
    }
    public function setImagen($value)
    {
        $this->imagen = $value;
    }

    // END GETTER & SETTER

    public function save()
    {
        $sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null)";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        // comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            // verificar la contraseña 
            $verify = password_verify($password, $usuario->password);
           
            if($verify){
                $result = $usuario;
            }

        }
        return $result;
    }
}
