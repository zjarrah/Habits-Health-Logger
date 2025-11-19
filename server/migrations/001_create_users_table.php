<?php
include("../connection/connection.php");

$sql = "CREATE TABLE IF NOT EXISTS users(
          id INT(11) AUTO_INCREMENT PRIMARY KEY,
          email VARCHAR(255) NOT NULL,
          password VARCHAR(255) NOT NULL,
          is_admin INT(11) NOT NULL,
          name VARCHAR(255) NULL,
          dob DATE NULL,
          phone_number VARCHAR(255) NULL,
          created_at DATE NOT NULL,
          last_updated DATE NOT NULL";

$query = $connection->prepare($sql);
$query->execute();

echo "Table Created!";

?>