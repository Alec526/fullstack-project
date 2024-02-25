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
    echo "<div class='event'>";
    echo "<h2 class='date'>" . htmlspecialchars($event_day['day']) . "</h2>";

    $events = get_events_by_day($conn, $event_day['day']);

    // Display each event for the day
    foreach ($events as $event) {
      display_event($conn, $event, $event_day['day']);
    }
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
  echo "<div class='eventdata' onclick='showPopup(\"" . htmlspecialchars($eventID) . "\")'>";
  // Display basic event data
  echo "<h3>" . htmlspecialchars($event['naam']) . "</h3>";
  $tijd = date('H:i', strtotime($event['datum']));
  echo "<p>" . htmlspecialchars($tijd) . "</p>";
  echo "<p>" . htmlspecialchars($event['prijs']) . "</p>";

  $bands = get_band_by_event($conn, $event['id']);

  // Display bands for the event
  echo "<ul class='no-list'>";
  if (!empty($bands)) {
    echo "<lh>Bands:</lh>";
    foreach ($bands as $band) {
      echo "<li>" . htmlspecialchars($band['naam']) . "</li>";
    }
  }
  echo "</ul>";


  echo "</div>"; // Close .eventdata

  // Include popup content for each event
  include 'comp/event-popup.php';
}

// Function to get band by event
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
  // Set the content-type
  $base64EncodedString = '';
  try {
    $text1 = 'Hello, this is your ticket for ' . $event['naam'] . '.';
    $key = getRandKey(10);
    $text2 = 'Your ticket key is: ' . $key . '. Thank you for visiting Casus Cafe!';

    // Create the image
    $height = max(strlen($text1) * 10, strlen($text2) * 14);
    $im = imagecreatetruecolor($height, 100); // Increased height to accommodate two lines of text

    // Create some colors
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, $height - 1, 99, $white);

    // The font to use
    $font = 'C:\wamp64\www\fullstack-project\fonts\Arial.ttf'; // Replace with the path to your font file

    // Add the first line of text
    imagettftext($im, 20, 0, 10, 30, $black, $font, $text1);

    // Add the second line of text, adjusting the y-coordinate to simulate a newline
    imagettftext($im, 20, 0, 10, 60, $black, $font, $text2);

    // Start output buffering
    ob_start();
    imagepng($im);
    $imageData = ob_get_contents();
    ob_end_clean();

    // Cleanup
    imagedestroy($im);

    // Encode the image data
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
?>
