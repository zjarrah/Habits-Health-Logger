<?php
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../services/ResponseService.php");
require_once(__DIR__ . "/../services/EntryServices.php");


class EntryController {

    function getEntries($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            $entry = Entryservice::findEntryByID($id);
            echo ResponseService::response(200, $entry); 
            return;
        }else{
            $entries = Entry::findAll($connection);
            echo ResponseService::response(200, $entries);
            return;
        }
    }


    function addEntry($data){
        global $connection;

        if(isset($data["userID"]) && isset($data["userInput"]) && isset($data["aiInput"])){
            $userID = $data["userID"];
            $userInput = $data["userInput"];
            $aiInput = $data["aiInput"];

            Entry::insertEntry($connection, $userID, $userInput, $aiInput);
            echo ResponseService::response(200, ["Entry inserted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field(s) missing!"]);
            return;
        }
    }


    function updateEntry($data){
        global $connection;

        if(isset($data["id"]) && isset($data["userInput"]) && isset($data["aiInput"])){
            $id = $data["id"];
            $userInput = $data["userInput"];
            $aiInput = $data["aiInput"];

            Entry::updateEntry($connection, $id, $userInput, $aiInput);
            echo ResponseService::response(200, ["Entry updated!"]);
            return;
        }else{
            echo ResponseService::response(500, ["Field missing!"]);
            return;
        }
    }


    function deleteEntry($data){
        global $connection;

        if(isset($data["id"])){
            $id = $data["id"];

            Entry::deleteRecord($connection, $id);
            echo ResponseService::response(200, ["Entry deleted!"]);
            return;
        }else{
            echo ResponseService::response(500, ["id missing"]);
            return;
        }
    }
}

?>