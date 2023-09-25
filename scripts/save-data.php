<?php
require_once '../database.php';

// code will not work if empty fields
if (!isset($_POST['submit'])) die('No valid data received');

$bandnaam = $_POST['naam'];
$genre = $_POST['genre'];
$date = $_POST['date'];
$eventnaam = $_POST['eventnaam'];
$entreeprijs = $_POST['entreeprijs'];

$stmt = $conn->prepare(
'INSERT INTO band (naam) VALUES (:naam);
INSERT INTO band_has_genres (band_id, genres_id) VALUES ((SELECT id FROM band WHERE naam = :naam), :genre);
INSERT INTO evenementen (naam, datum, prijs, band_id) VALUES (:eventnaam, :date, :entreeprijs, (SELECT id FROM band WHERE naam = :naam));'
);
$stmt->execute(array(
  ':naam' => $bandnaam,
  ':genre' => $genre,
  ':eventnaam' => $eventnaam,
  ':date' => $date,
  ':entreeprijs' => $entreeprijs
));

header('Location: ../admin.php?data_saved=true');
