<?php
require_once(__DIR__ . "/../models/Habit.php");
require_once(__DIR__ . "/../connection/connection.php");


class HabitService{

    static function findHabitById($id){
        global $connection;
        $habit = Habit::find($connection, $id);
        $habit = $habit ? $habit->toArray() : [];
        return $habit;
    }
}

?>