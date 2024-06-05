<?php
include 'admin/dbh.php';


// Fetch random quotes from the database
$sql = "SELECT quote, source FROM quotes ORDER BY RAND() LIMIT 6";
$result = $conn->query($sql);

// Output quotes HTML
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="quote-card">';
        echo '<p class="quote-text">' . $row["quote"] . '</p>';
        echo '<p class="quote-source">- ' . $row["source"] . '</p>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();