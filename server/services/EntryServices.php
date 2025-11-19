<?php
require_once(__DIR__ . "/../models/Entry.php");
require_once(__DIR__ . "/../connection/connection.php");


class EntryService{

    static function findEntryById($id){
        global $connection;
        $entry = Entry::find($connection, $id);
        $entry = $entry ? $entry->toArray() : [];
        return $entry;
    }
}

?>