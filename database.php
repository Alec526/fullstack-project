<?php

//establishing connection with database
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
//saving user input into database
$bandnaam = $_POST['bandnaam'];
$genre = $_POST['genre'];
$date = $_POST['date'];
$aanvangstijd = $_POST['aanvangstijd'];
$eventnaam = $_POST['eventnaam'];
$entreeprijs = $_POST['entreeprijs'];

$sql = "INSERT INTO users (user_bandnaam, user_genre, user_date, user_aanvangstijd, user_eventnaam, user_entreeprijs)
 VALUES ('$bandnaam', '$genre', '$date', '$aanvangstijd', '$eventnaam', '$entreeprijs');";
mysqli_query($conn, $sql);


//testing if query can be fetched from database
$query = "SELECT * from gast";
$stmt = $conn->prepare($query) or die ("Error 1.");
$stmt->execute() or die ("Error 2.");
$row = $stmt->fetch() or die ("Error 3.");
echo $row["idgast"];
