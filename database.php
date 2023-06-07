<?php

$servername = "localhost";
$dbname = "casus_cafe";
$username = "root";
$password = "pass";

try {
    $conn = new PDO("mysql:host=$servername;dbname=casus_cafe", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}