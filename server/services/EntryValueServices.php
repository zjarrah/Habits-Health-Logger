<?php
require_once(__DIR__ . "/../models/EntryValue.php");
require_once(__DIR__ . "/../connection/connection.php");


class EntryValueService{

    static function findEntryValueById($id){
        global $connection;
        $entryValue = EntryValue::find($connection, $id);
        $entryValue = $entryValue ? $entryValue->toArray() : [];
        return $entryValue;
    }
}

?>