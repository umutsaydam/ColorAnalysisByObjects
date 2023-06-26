<?php
include_once "config/database.php";
class SubClasses{
    private $conn;
    private $db_table = "sub_classes";
    private $sub_class_id;
    private $sub_class_name;
    private $main_class_id;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getSubClassID(){
        return $this->sub_class_id;
    }

    public function setSubClassID(int $sub_class_id){
        $this->sub_class_id = $sub_class_id;
    }

    public function getSubClassName(){
        return $this->sub_class_name;
    }

    public function setSubClassName($sub_class_name){
        $this->sub_class_name = $sub_class_name;
    }

    public function getMainClassID(){
        return $this->main_class_id;
    }

    public function setMainClassID(int $main_class_id){
        $this->main_class_id = $main_class_id;
    }

    function getSubAllClasses(){
        $sqlQuery = "SELECT * FROM sub_classes;";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array();

        foreach ($dataRows as $dataRow) {
            $result[] = array("sub_class_id"=>$dataRow["sub_class_id"], "sub_class_name"=>$dataRow["sub_class_name"], "main_class_id"=>$dataRow["main_class_id"]);
        }
        if ($result != null) {
            return $result;
        }
        return null;
    }

    function getSubClass() {
        $sqlQuery = "SELECT * FROM sub_classes WHERE sub_class_id = :sub_class_id;";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":sub_class_id", $this->sub_class_id);
        $stmt->execute();
        $dataRows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = array();


        if ($dataRows != null) {
            return array("sub_class_id"=>$dataRows["sub_class_id"], "sub_class_name"=>$dataRows["sub_class_name"], "main_class_id"=>$dataRows["main_class_id"]);
        }
        return null;
    }

    function getSubClassesWithParentClass() {
        $sqlQuery = "SELECT class_id, class_name, sub_class_id, sub_class_name FROM ". $this->db_table ." 
            INNER JOIN classes 
                ON sub_classes.main_class_id = classes.class_id";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array();
        /*
        foreach ($dataRows as $dataRow) {
            $result[] = array("class_id"=>$dataRow["class_id"], "class_name"=>$dataRow["class_name"], "sub_class_id"=>$dataRow["sub_class_id"], "sub_class_name"=>$dataRow["sub_class_name"]);
        }*/
        if ($dataRows != null) {
            return $dataRows;
        }
        return null;
    }
}
