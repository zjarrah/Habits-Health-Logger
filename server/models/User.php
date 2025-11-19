<?php
include("Model.php");

class User extends Model {
    private int $id;
    private string $email;
    private string $password;
    private int $isAdmin;
    private string $name;
    private string $dob;
    private string $phoneNumber;
    private string $createdAt;
    private string $lastUpdated;

    protected static string $table = "users";

    public function __construct(array $data){
        $this->id = $data["id"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->isAdmin = $data["is_admin"];
        $this->name = $data["name"];
        $this->dob = $data["dob"];
        $this->phoneNumber = $data["phone_number"];
        $this->createdAt = $data["created_at"];
        $this->lastUpdated = $data["last_updated"];
    }

    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getDOB(){
        return $this->dob;
    }

    public function setDOB(string $dob){
        $this->dob = $dob;
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber){
        $this->phoneNumber = $phoneNumber;
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

    public static function insertUser(mysqli $connection, string $email, string $password, int $isAdmin, string $name,
                                        string $dob, int $phoneNumber, string $createdAt, string $lastUpdated){
        $sql = sprintf("INSERT INTO %s (email, password, is_admin, name, dob, phone_number, created_at, last_updated) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("ssisssss", $email, $password, $isAdmin, $name, $dob, $phoneNumber, $createdAt, $lastUpdated);
        $query->execute();               
    }

    public static function updateUser(mysqli $connection, int $id, string $password, string $name,
                                        string $dob, int $phoneNumber, string $lastUpdated){
        $sql = sprintf("UPDATE %s SET password = ?, name = ?, dob = ?, phone_number = ?, last_updated = ? WHERE id = ?",
            self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("sssssi", $password, $name, $dob, $phoneNumber, $lastUpdated, $id);
        $query->execute();               
    }

    public static function findByEmail(mysqli $connection, string $email){
        $sql = sprintf("SELECT * FROM %s WHERE email = ?",
                       self::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();               

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    
    public function toArray(){
        return ["id" => $this->id, "email" => $this->email, "password" => $this->password, "isAdmin" => $this->isAdmin, "name" => $this->name,
                    "dob" => $this->dob, "phoneNumber" => $this->phoneNumber, "createdAt" => $this->createdAt, "lastUpdated" => $this->lastUpdated];
    }

}

?>