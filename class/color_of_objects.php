<?php
include_once "config/database.php";
class color_of_objects{
    private $conn;
    private $db_table = "color_of_objects";
    private $color_of_objects_id;
    private $color_rgb;
    private $sub_class;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getColorOfObjectsID(){
        return $this->color_of_objects_id;
    }

    public function setColorOfObjectsID(int $color_of_objects_id){
        $this->color_of_objects_id = $color_of_objects_id;
    }

    public function getColorRgb(){
        return $this->color_rgb;
    }

    public function setColorRgb($color_rgb){
        $this->color_rgb = $color_rgb;
    }

    public function getSubClass(){
        return $this->sub_class;
    }

    public function setSubClass($sub_class){
        $this->sub_class = $sub_class;
    }

    function createColorValue() {
        $sqlQuery = "INSERT INTO ". $this->db_table ."(
            color_rgb,
            sub_class
        )
        VALUES
        (:color_rgb, :sub_class)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":color_rgb", $this->color_rgb);
        $stmt->bindParam(":sub_class", $this->sub_class);
        if ($stmt->execute()) {
            return "ok";
        }

        return null;
    }
}
