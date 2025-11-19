<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/EntryValue.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/EntryValueServices.php");


class EntryValueController {

    function getEntryValues($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            $entryValue = EntryValueService::findEntryValueByID($id);
            echo ResponseService::response(200, $entryValue); 
            return;
        }else{
            $entryValues = EntryValue::findAll($connection);
            echo ResponseService::response(200, $entryValues);
            return;
        }
    }


    function addEntryValue($data){
        global $connection;

        if(isset($data["userID"]) && isset($data["habitID"]) && isset($data["value"])){
            $userID = $data["userID"];
            $habitID = $data["habitID"];
            $value = $data["value"];

            EntryValue::insertEntryValue($connection, $userID, $habitID, $value);
            echo ResponseService::response(200, ["EntryValue inserted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field(s) missing!"]);
            return;
        }
    }


    function updateEntryValue($data){
        global $connection;

        if(isset($data["id"]) && isset($data["value"])){
            $id = $data["id"];
            $value = $data["value"];

            EntryValue::updateEntryValue($connection, $id, $value);
            echo ResponseService::response(200, ["EntryValue updated!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field missing!"]);
            return;
        }
    }


    function deleteEntryValue($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            EntryValue::deleteRecord($connection, $id);
            echo ResponseService::response(200, ["EntryValue deleted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["id missing"]);
            return;
        }
    }
}

?>