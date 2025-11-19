<?php
include("Model.php");

class Habit extends Model {
    private int $id;
    private string $name;
    private string $measurementUnit;
    private string $createdAt;
    private string $lastUpdated;

    protected static string $table = "habits";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->measurementUnit = $data["measurement_unit"];
        $this->createdAt = $data["created_at"];
        $this->lastUpdated = $data["last_updated"];
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getMeasurementUnit(){
        return $this->measurementUnit;
    }

    public function setMeasurementUnit(string $measurementUnit){
        $this->measurementUnit = $measurementUnit;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt){
        $this->createdAt = $createdAt;
    }

    public function getLastUpdated(){
        return $this->lastUpdated;
    }

    public function setLastUpdated(string $lastUpdated){
        $this->lastUpdated = $lastUpdated;
    }

    public static function insertHabit(mysqli $connection, string $name, string $measurementUnit,
                                        string $createdAt = date('Y-m-d'), string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("INSERT INTO %s (name, measurement_unit, created_at, last_updated) VALUES (?, ?, ?, ?)",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("ssss", $name, $measurementUnit, $createdAt, $lastUpdated);
        $query->execute();               
    }

    public static function updateHabit(mysqli $connection, int $id, string $name, string $measurementUnit, string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("UPDATE %s SET name = ?, measurement_unit = ?, last_updated = ? WHERE id = ?",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("sssi", $name, $measurementUnit, $lastUpdated, $id);
        $query->execute();               
    }

    
    public function toArray(){
        return ["id" => $this->id, "name" => $this->name, "measurementUnit" => $this->measurementUnit,
                    "createdAt" => $this->createdAt, "lastUpdated" => $this->lastUpdated];
    }

}

?>
