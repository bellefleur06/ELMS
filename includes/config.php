<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "elms";

try {
    $conn =  new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<script>alert('Database Connection Successful!')</script>";
} catch (PDOException $e) {
    echo "Database Connection Failed!" . $e->getMessage();
}

session_start();
