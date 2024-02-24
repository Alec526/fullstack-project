<?php
require_once 'database.php';

// Function to get all event days
function get_event_days($conn) {
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
function get_events_by_day($conn, $day) {
    $stmt = $conn->prepare('SELECT * FROM evenementen WHERE DATE(datum) = :day ORDER BY datum ASC;');
    $stmt->execute(array(':day' => $day));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to display each event
function display_event($conn, $event, $event_day) {
    $eventID = "popup-" . htmlspecialchars($event['id']);
    echo "<div class='eventdata' onclick='showPopup(\"" . htmlspecialchars($eventID) . "\")'>";
    echo "<h3>" . htmlspecialchars($event['naam']) . "</h3>";

    $band = get_band_by_event($conn, $event['id']);

    // Display basic event data
    echo "<p>" . htmlspecialchars($band['naam']) . "</p>";
    $tijd = date('H:i', strtotime($event['datum']));
    echo "<p>" . htmlspecialchars($tijd) . "</p>";
    echo "<p>" . htmlspecialchars($event['prijs']) . "</p>";

    echo "</div>"; // Close .eventdata

    // Include popup content for each event
    include 'comp/event-popup.php';
}

// Function to get band by event
function get_band_by_event($conn, $eventId) {
    $stmt = $conn->prepare('SELECT id, naam FROM band WHERE id = (SELECT band_id FROM evenementen WHERE id = :id);');
    $stmt->execute(array(':id' => $eventId));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<script>
function showPopup(id) {
    console.log("open popup: " + id);
    document.getElementById(id).style.display = 'block';
}

function closePopup(id) {
    console.log("close popup: " + id);
    document.getElementById(id).style.display = 'none';
}

function openTicketsPopup(id) {
    console.log("get tickets for: " + id);
    closePopup(id);
    showPopup('get-tickets-' + id);
}
</script>
