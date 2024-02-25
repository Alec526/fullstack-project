<?php
require_once '../database.php';

// code will not work if empty fields
if (!isset($_POST['submit'])) header('Location: ' . $_SERVER['HTTP_REFERER'] . '?band_saved=false');

$bandnaam = $_POST['naam'];
$genre = $_POST['genre'];


$stmt = $conn->prepare(
  'INSERT INTO band (naam) VALUES (:naam);
  INSERT INTO band_has_genres (band_id, genres_id) VALUES ((SELECT id FROM band WHERE naam = :naam), :genre);'
);

$stmt->execute(array(
  ':naam' => $bandnaam,
  ':genre' => $genre
));

// return to last page
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?band_saved=true');
