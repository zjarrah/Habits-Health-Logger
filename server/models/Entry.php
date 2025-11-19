<?php
include("Model.php");

class Entry extends Model {
    private int $id;
    private int $userID;
    private string $userInput;
    private string $aiInput;
    private string $createdAt;
    private string $lastUpdated;

    protected static string $table = "entries";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->userId = $data["userID"];
        $this->userInput = $data["userInput"];
        $this->aiInput = $data["aiInput"];
        $this->createdAt = $data["createdAt"];
        $this->lastUpdated = $data["lastUpdated"];
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getUserInput(){
        return $this->userInput;
    }

    public function setUserInput(string $userInput){
        $this->userInput = $userInput;
    }

    public function getAiInput(){
        return $this->aiInput;
    }

    public function setAiInput(string $aiInput){
        $this->aiInput = $aiInput;
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

    public static function insertEntry(mysqli $connection, int $userID, string $userInput, string $aiInput, 
                                        string $createdAt = date('Y-m-d'), string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("INSERT INTO %s (user_id, user_input, ai_input, created_at, last_updated) VALUES (?, ?, ?, ?, ?)",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("issss", $userID, $userInput, $aiInput, $createdAt, $updatedAt);
        $query->execute();               
    }

    public static function updateEntry(mysqli $connection, int $id, string $userInput, string $aiInput, string $lastUpdated = date('Y-m-d')){
        $sql = sprintf("UPDATE %s SET user_input = ?, ai_input = ?, last_updated = ? WHERE id = ?",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("sssi", $userInput, $aiInput, $last_updated, $id);
        $query->execute();               
    }

    
    public function toArray(){
        return ["id" => $this->id, "userID" => $this->userID, "userInput" => $this->userInput, "aiInput" => $this->aiInput,
                    "createdAt" => $this->createdAt, "updatedAt" => $this->updatedAt];
    }

}

?>