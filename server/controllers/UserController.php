<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/User.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/UserServices.php");


class UserController {

    function signInUser($data){
        global $connection;

        $emailAndPasswordArePresent = UserService::checkIfEmailAndPasswordWereInputted($data);

        if($emailAndPasswordArePresent){
            $email = $data["email"];
            $password = hash('sha256', $data["password"]);

            $emailExists = UserService::checkIfEmailExists($email);
            
            if($emailExists){

                $passwordIsCorrect = UserService::checkIfPasswordIsCorrect($email, $password);
    
                if($passwordIsCorrect){
                    $user = UserService::findUserByEmail($email);
                    echo ResponseService::response(200, $user); 
                    return;
                }else{
                    echo ResponseService::response(500, ["Email or password is incorrect"]);
                    return;
                }
                
            }else{
                echo ResponseService::response(500, ["Email or password is incorrect"]);
                return;
            }
            
        }else{
            echo ResponseService::response(500, ["Field(s) missing!"]);
            return;
        }
    }


    function getUser($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            $user = UserService::findUserByID($id);
            echo ResponseService::response(200, $user); 
            return;
        }else{
            echo ResponseService::response(500, ["id missing!"]);
            return;
        }
    }


    function getUsers($data){
        global $connection;
        
        $users = User::findAll($connection);
        echo ResponseService::response(200, $users);
        return;
    }


    function addUser($data){
        global $connection;

        if(isset($data["email"]) && isset($data["password"])){
            $email = $data["email"];
            $password = hash('sha256', $data["password"]);
            $isAdmin = 0;
            $name = '';
            $dob = '';
            $phoneNumber = '';
            $createdAt = date('Y-m-d');
            $lastUpdated = date('Y-m-d');

            User::insertUser($connection, $email, $password, $isAdmin, $name, $dob, $phoneNumber, $createdAt, $lastUpdated);
            echo ResponseService::response(200, ["User inserted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field(s) missing!"]);
            return;
        }
    }


    function updateUser($data){
        global $connection;

        if(isset($data["id"]) && isset($data["password"])){
            $id = $data["id"];
            $password = hash('sha256', $data["password"]);
            $name = $data["name"] ? $data["name"] : null;
            $dob = $data["dob"] ? $data["dob"] : null;
            $phoneNumber = $data["phoneNumber"] ? $data["phoneNumber"] : null;
            $lastUpdated = date('Y-m-d');

            User::updateUser($connection, $id, $password, $name, $dob, $phoneNumber);
            echo ResponseService::response(200, ["User updated!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field missing!"]);
            return;
        }
    }


    function deleteUser($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            User::deleteRecord($connection, $id);
            echo ResponseService::response(200, ["User deleted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["id missing"]);
            return;
        }
    }
}

?>