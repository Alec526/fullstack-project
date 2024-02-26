<?php
require_once '../database.php';

// code werkt niet als fields leeg zijn
if (!isset($_POST['submit'])) header('Location: ' . $_SERVER['HTTP_REFERER'] . '?data_saved=false');

try {
  $band_id = $_POST['band_id'];
  $event_id = $_POST['event_id'];

  $stmt = $conn->prepare(
    'INSERT INTO evenementen_has_band (evenementen_id, band_id) VALUES (:event_id, :band_id);'
  );

  $stmt->execute(array(
    ':event_id' => $event_id,
    ':band_id' => $band_id
  ));
  // replace met laatste pagina en verwijder oude query
  $referer = $_SERVER['HTTP_REFERER'];
  $referer = explode('?', $referer)[0];
  header('Location: ' .  $referer . '?data_saved=true');
} catch (PDOException $e) {
  $referer = $_SERVER['HTTP_REFERER'];
  $referer = explode('?', $referer)[0];
  if (str_contains($e->getMessage(), 'Duplicate entry')) {

    header('Location: ' . $referer . '?data_saved=false');
  } else {
    echo "Connection failed: " . htmlspecialchars($e->getMessage());

    // terug naar vorige pagina na 2 seconden
    header("refresh:2;url=" . $referer);
  }
}

