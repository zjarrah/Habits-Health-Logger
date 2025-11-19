<?php
include("../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS entry_values(
          id INT(11) AUTO_INCREMENT PRIMARY KEY,
          user_id INT(11) NOT NULL,
          habit_id INT(11) NOT NULL,
          value INT(11) NOT NULL,
          created_at DATE NOT NULL,
          last_updated DATE NOT NULL";

$query = $connection->prepare($sql);
$query->execute();

echo "Table Created!";

?>