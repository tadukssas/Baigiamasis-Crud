<?php
include "./models/db.php";
class Plant{
    public $id;
    public $name;
    public $nameL;
    public $perennial;
    public $age;
    public $height;

    public function __construct($id, $name, $nameL, $perennial, $age, $height) {
        $this->id = $id;
        $this->name = $name;
        $this->nameL = $nameL;
        $this->perennial = $perennial;
        $this->age = $age;
        $this->height = $height;
    }

    public static function find($id)
    {

        $db = new DB();
        $sql = "SELECT * FROM `plants` where `id` =". $id;
        $result = $db->conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $plant = new Plant($row["id"], $row["name"], $row["nameL"], $row["perennial"], $row["age"], $row["height"]);
        }
        $db->conn->close();
        return $plant;
    }

    public static function all()
    {
       $plants = [];
       $db = new DB();
       $sql = "SELECT * FROM `plants`";
       $result = $db->conn->query($sql);

       while($row = $result->fetch_assoc()) {
           $plants[] = new Plant($row["id"], $row["name"], $row["nameL"], $row["perennial"], $row["age"], $row["height"]);
       }
       $db->conn->close();
       return $plants;
    }

    public static function create(){
        $db = new DB();
        $stmt = $db->conn->prepare("INSERT INTO plants (name, nameL, perennial, age, height) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $_POST['name'], $_POST['nameL'], $_POST['perennial'], $_POST['age'],$_POST['height'],);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function update(){
        $db = new DB();
        $stmt = $db->conn->prepare("UPDATE plants SET name = ?, nameL = ?, perennial = ?, age = ?, height = ? WHERE id = ?");
        $stmt->bind_param("sssiii", $_POST['name'], $_POST['nameL'], $_POST['perennial'], $_POST['age'], $_POST['height'], $_POST['id']);

        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function destroy(){
        $db = new DB();
        $stmt = $db->conn->prepare("DELETE FROM plants WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }
    
}