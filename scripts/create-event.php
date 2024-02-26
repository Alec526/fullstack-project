<?php
require_once '../database.php';

// code werkt niet als fields leeg zijn
if (!isset($_POST['submit'])) header('Location: ' . $_SERVER['HTTP_REFERER'] . '?event_saved=false');

echo $_POST['date'];
echo $_POST['eventnaam'];
echo $_POST['entreeprijs'];

$date = $_POST['date'];
$eventnaam = $_POST['eventnaam'];
$entreeprijs = $_POST['entreeprijs'];

$stmt = $conn->prepare(
'INSERT INTO evenementen (naam, datum, prijs) VALUES (:eventnaam, :date, :entreeprijs);'
);
$stmt->execute(array(
  ':eventnaam' => $eventnaam,
  ':date' => $date,
  ':entreeprijs' => $entreeprijs
));

// terug naar vorige pagina
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?event_saved=true');
