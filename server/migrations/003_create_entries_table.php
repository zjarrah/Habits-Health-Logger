<?php
include("../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS entries(
          id INT(11) AUTO_INCREMENT PRIMARY KEY,
          user_id INT(11) NOT NULL,
          user_input TEXT NOT NULL,
          ai_input TEXT NOT NULL,
          created_at DATE NOT NULL,
          last_updated DATE NOT NULL";

$query = $connection->prepare($sql);
$query->execute();

echo "Table Created!";

?>