<?php
include_once "config/database.php";
class Classes{
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

    function getAllClasses(){
        $sqlQuery = "SELECT * FROM ". $this->db_table.";";
        
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array();

        foreach ($dataRows as $dataRow) {
            $result[] = array("class_id"=>$dataRow["class_id"], "class_name"=>$dataRow["class_name"]);
        }
        
        if ($result != null) {
            return $result;
        }
        return null;
    }
}
