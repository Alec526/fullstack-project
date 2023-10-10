<?php 
require_once 'database.php';
try {
  $event_days = get_event_days($conn);

  foreach ($event_days as $event_day) {
    echo "<div class='event'>";
    echo "<h2 class='date'>" . $event_day['day'] . "</h2>";
    $stmt = $conn->prepare('SELECT * FROM evenementen WHERE DATE(datum) = :day ORDER BY datum ASC;');
    $stmt->execute(array(':day' => $event_day['day']));
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as $event) {
      echo "<div class='eventdata'>";
      echo "<h3>" . $event['naam'] . "</h3>";
      $stmt = $conn->prepare('SELECT id, naam FROM band WHERE id = (SELECT band_id FROM evenementen WHERE id = :id);');
      $stmt->execute(array(':id' => $event['id']));
      $band = $stmt->fetch(PDO::FETCH_ASSOC);
      echo "<p>" . $band['naam'] . "</p>";
      $stmt = $conn->prepare('SELECT');
      $tijd = date('H:i', strtotime($event['datum']));
      echo "<p>" . $tijd . "</p>";
      echo "<p>" . $event['prijs'] . "</p>";
      echo "</div>";
    }
    echo "</div>";
  }
  
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function get_event_days($conn) {
  $strm = $conn->prepare('SELECT DATE(datum) as day FROM evenementen group by day ORDER BY day ASC;');
  $strm->execute();
  $event_days = $strm->fetchAll(PDO::FETCH_ASSOC);
  return $event_days;
}