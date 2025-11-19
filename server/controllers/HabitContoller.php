<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Habit.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/HabitServices.php");


class HabitController {

    function getHabits($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            $habit = HabitService::findHabitByID($id);
            echo ResponseService::response(200, $habit); 
            return;
        }else{
            $habits = Habit::findAll($connection);
            echo ResponseService::response(200, $habit);
            return;
        }
    }


    function addHabit($data){
        global $connection;

        if(isset($data["name"]) && isset($data["measurementUnit"])){
            $name = $data["name"];
            $measurementUnit = $data["measurementUnit"];

            Habit::insertHabit($connection, $name, $measurementUnit);
            echo ResponseService::response(200, ["Habit inserted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field(s) missing!"]);
            return;
        }
    }


    function updateHabit($data){
        global $connection;

        if(isset($data["id"]) && isset($data["name"]) && isset($data["measurementUnit"])){
            $id = $data["id"];
            $name = $data["name"];
            $measurementUnit = $data["measurementUnit"];

            Habit::updateHabit($connection, $id, $name, $measurementUnit);
            echo ResponseService::response(200, ["Habit updated!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field missing!"]);
            return;
        }
    }


    function deleteHabit($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            Habit::deleteRecord($connection, $id);
            echo ResponseService::response(200, ["Habit deleted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["id missing"]);
            return;
        }
    }
}

?>