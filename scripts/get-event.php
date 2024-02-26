<?php
require_once 'database.php';

// Function to get all event days
function get_event_days($conn)
{
  $stmt = $conn->prepare('SELECT DATE(datum) as day FROM evenementen GROUP BY day ORDER BY day ASC;');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Main try-catch block for database operations
try {
  $event_days = get_event_days($conn);

  if (empty($event_days)) {
    echo "<p class='warning'>No events found.</p>";
  }

  // Loop through each event day
  foreach ($event_days as $event_day) {
    echo "<div class='event-day'>";
    echo "<h2 class='date'>" . date('D d M', strtotime($event_day['day'])) . "</h2>";

    $events = get_events_by_day($conn, $event_day['day']);
    echo "<div class='events'>";
    // Display each event for the day
    foreach ($events as $event) {
      display_event($conn, $event, $event_day['day']);
    }
    echo "</div>"; // Close .events
    echo "</div>"; // Close .event
  }
} catch (PDOException $e) {
  echo "Connection failed: " . htmlspecialchars($e->getMessage());
}

// Function to get events by day
function get_events_by_day($conn, $day)
{
  $stmt = $conn->prepare('SELECT * FROM evenementen WHERE DATE(datum) = :day ORDER BY datum ASC;');
  $stmt->execute(array(':day' => $day));
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to display each event
function display_event($conn, $event, $event_day)
{
  $eventID = "popup-" . htmlspecialchars($event['id']);
  echo "<div class='event'>";
  echo "<div class='eventdata' onclick='showPopup(\"" . htmlspecialchars($eventID) . "\")'>";
  // Display basic event data
  echo "<h3 class='naam'>" . htmlspecialchars($event['naam']) . "</h3>";
  $tijd = date('H:i', strtotime($event['datum'])); // important also used in popup

  $bands = get_band_by_event($conn, $event['id']);

  // Display bands for the event
  echo "<div class='bands'>";
  if (!empty($bands)) {
    echo "<h6>Bands: ";
    foreach ($bands as $band) {
      echo  htmlspecialchars($band['naam']);
      if (next($bands)) {
        echo ", ";
      }
    }
    echo "</h6>";
  }
  echo "</div>";


  echo "</div>"; // Close .eventdata

  echo "</div>"; // Close .event-content
  include 'comp/event-popup.php';
}

function get_band_by_event($conn, $eventId)
{
  $stmt = $conn->prepare('SELECT b.id, b.naam FROM band AS b
                          JOIN evenementen_has_band AS ehb ON b.id = ehb.band_id
                          WHERE ehb.evenementen_id = :id;');
  $stmt->execute(array(':id' => $eventId));
  return $stmt->fetchAll(PDO::FETCH_ASSOC); // Note: fetchAll assuming multiple bands can be associated with a single event
}

function createTicket($event)
{
  // Set content-type en voeg texten toe
  $base64EncodedString = '';
  try {
    $text1 = 'Bedankt voor je boeking bij ' . $event['naam'] . '.';
    $key = getRandKey(10);
    $text2 = 'Jouw ticket succesvol is geboekt. Dit is je ticket key: ' . $key . '. Bedankt dat je met ons meedoet!';

    // Maak image aan
    $height = max(strlen($text1) * 10, strlen($text2) * 14);
    $im = imagecreatetruecolor($height, 100); // Increased height to accommodate two lines of text

    // Maak kleuren aan
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, $height - 1, 99, $white);

    // Voeg font toe
    $font = 'C:\wamp64\www\fullstack-project\fonts\Arial.ttf'; // Replace with the path to your font file

    // Eerste lijn text
    imagettftext($im, 20, 0, 10, 30, $black, $font, $text1);

    // Tweede lijn text
    imagettftext($im, 20, 0, 10, 60, $black, $font, $text2);

    // Output buffering
    ob_start();
    imagepng($im);
    $imageData = ob_get_contents();
    ob_end_clean();

    // Cleanup
    imagedestroy($im);

    // Encode image data
    $base64EncodedString = base64_encode($imageData);
  } catch (Exception $e) {
    $base64EncodedString = $e->getMessage();
  }

  return $base64EncodedString;
}
function getRandKey($length)
{
  $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $randStr = str_shuffle($str);
  return substr($randStr, 0, $length);
}


function generageLorumIpsum($length = 1)
{
  $loremBase = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec odio nec nunc tincidunt tincidunt. Donec auctor, nunc nec";
  $lorem = $loremBase;
  for ($i = 0; $i < $length; $i++) {
    $lorem .= " " . $loremBase;
  }

  return $lorem; 
}