<?php
include_once "config/database.php";
class color_of_objects{
    private $conn;
    private $db_table = "classes";
    private $class_id;
    private $class_name;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getClass_ID(){
        return $this->class_id;
    }

    public function setClass_id(int $class_id){
        $this->class_id = $class_id;
    }

    public function getColor_rgb(){
        return $this->class_name;
    }

    public function setClass_name($class_name){
        $this->class_name = $class_name;
    }
}
