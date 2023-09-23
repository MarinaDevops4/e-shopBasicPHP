<?php

class DataBase{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db->set_charset("utf8mb4");
        return $db;
    }
}