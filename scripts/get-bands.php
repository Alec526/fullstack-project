<?php
require_once '../database.php';

// get all bands
function get_bands($conn) {
    $stmt = $conn->prepare('SELECT * FROM band;');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Main try-catch block for database operations
try {
    $bands = get_bands($conn);

    if (empty($bands)) {
        echo "<p class='warning'>No bands found.</p>";
    }

    // Loop through each band
    foreach ($bands as $band) {
        echo "<div class='band'>";
        echo "<h2 class='bandnaam'>" . htmlspecialchars($band['naam']) . "</h2>";
        echo "<p class='genre'>" . htmlspecialchars($band['genre']) . "</p>";
        echo "</div>"; // Close .band
}
} catch (PDOException $e) {
    echo "Connection failed: " . htmlspecialchars($e->getMessage());
}