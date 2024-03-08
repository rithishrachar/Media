<?php

$dsn = "mysql:host=localhost;dbname=nk;charset=utf8";
$username = "root";
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Additional configuration options if needed
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
