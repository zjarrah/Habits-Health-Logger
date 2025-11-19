<?php
include("Model.php");

class EntryValue extends Model {
    private int $id;
    private int $userID;
    private int $habitID;
    private int $value;
    private string $createdAt;
    private string $lastUpdated;

    protected static string $table = "entry_values";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->userId = $data["user_id"];
        $this->habitId = $data["habit_id"];
        $this->value = $data["value"];
        $this->createdAt = $data["created_at"];
        $this->lastUpdated = $data["last_updated"];
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getHabitId(){
        return $this->habitId;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue(string $value){
        $this->value = $value;
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

    public static function insertEntryValue(mysqli $connection, int $userID, int $habitID, int $value, 
                                        string $createdAt = date('Y-m-d'), string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("INSERT INTO %s (user_id, habit_id, value, created_at, last_updated) VALUES (?, ?, ?, ?, ?)",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("iiiss", $userID, $habitID, $value, $createdAt, $lastUpdated);
        $query->execute();               
    }

    public static function updateEntryValue(mysqli $connection, int $id, string $value, string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("UPDATE %s SET value = ?, last_updated = ? WHERE id = ?",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("isi", $value, $lastUpdated, $id);
        $query->execute();               
    }

    
    public function toArray(){
        return ["id" => $this->id, "userID" => $this->userID, "habitID" => $this->habitID, "value" => $this->value,
                    "createdAt" => $this->createdAt, "lastUpdated" => $this->lastUpdated];
    }

}

?>