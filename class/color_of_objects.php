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

    function getColorsWithParents() {
        $sqlQuery = "SELECT class_id, class_name, sub_class_id, sub_class_name, color_of_object_id, color_rgb FROM classes
            INNER JOIN (SELECT main_class_id, sub_class_id, sub_class_name, color_of_object_id, color_rgb FROM color_of_objects 
                INNER JOIN sub_classes
                    ON color_of_objects.sub_class = sub_classes.sub_class_id) as fullData
                        ON fullData.main_class_id = classes.class_id;";
        
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();

        $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($dataRows != null) {
            return $dataRows;
        }
        return null;
    }
}
