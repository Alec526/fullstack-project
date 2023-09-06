<?php

$servername = "localhost";
$dbname = "casus_cafe";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=casus_cafe", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$bandnaam = $_POST['bandnaam'];
$genre = $_POST['genre'];
$date = $_POST['date'];
$time = $_POST['time'];

$eventnaam = $_POST['eventnaam'];
$entreeprijs = $_POST['entreeprijs'];

$sql = "INSERT INTO band (band_naam, band_genre) VALUES ('$bandnaam', '$genre');";

$query = "SELECT * from gast";
$stmt = $conn->prepare($query) or die ("Error 1.");
$stmt->execute() or die ("Error 2.");
$row = $stmt->fetch() or die ("Error 3.");
echo $row["idgast"];
