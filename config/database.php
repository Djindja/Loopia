<?php

$host = "mysql";
$db_name = "loopia";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);

    $sql = "CREATE TABLE recordA (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(30) NOT NULL,
        name VARCHAR(30) NOT NULL,
        content VARCHAR(255) NOT NULL,
        ttl INT(11)
        )";
        $conn->exec($sql);

    $sql = "CREATE TABLE zone (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL
        )";
        $conn->exec($sql);

    $sql = "INSERT INTO zone (id, name)
        VALUES
        (1, 'serbia.com'),
        (2, 'greece.com'),
        (3, 'germany.com')";
        $conn->exec($sql);

    }
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>