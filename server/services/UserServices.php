<?php
require_once(__DIR__ . "/../models/User.php");
require_once(__DIR__ . "/../connection/connection.php");


class UserService{

    static function findUserById($id){
        global $connection;
        $user = User::find($connection, $id);
        $user = $user ? $user->toArray() : [];
        return $user;
    }

    static function findUserByEmail($email){
        global $connection;
        $user = User::findByEmail($connection, $email);
        $user = $user ? $user->toArray() : [];
        return $user;
    }

    static function checkIfEmailAndPasswordWereInputted($data){
        return (isset($data["email"]) && isset($data["password"]));
    }

    static function checkIfEmailExists($email){
        global $connection;
        $user = User::findByEmail($connection, $email);
        $user_exists = $user ? true : false;
        return $user_exists;
    }

    static function checkIfPasswordIsCorrect($email, $password){
        $user = self::findUserByEmail($email);
        return $user["password"]===$password;
    }
}

?>