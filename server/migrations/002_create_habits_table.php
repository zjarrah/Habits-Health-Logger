<?php
include("../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS habits(
          id INT(11) AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(255) NOT NULL,
          measurement_unit VARCHAR(255) NOT NULL,
          created_at DATE NOT NULL,
          last_updated DATE NOT NULL";

$query = $connection->prepare($sql);
$query->execute();

echo "Table Created!";

?>