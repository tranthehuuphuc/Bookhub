<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bookhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Set the character set to utf8mb4
$conn->set_charset("utf8mb4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Start session if not already started
    $user_id = $_SESSION["user_id"]; // Assuming you have set the user_id in the session
    $review = $_POST["review"];
    $rating = $_POST["rating"];

    // Generate the current date and time
    $rating_date = date("Y-m-d H:i:s");

    // Temporary book_id value
    $book_id = 57;

    // Prepare SQL statement
    $sql = "INSERT INTO ratings (user_id, book_id, review, rating, rating_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("iisds", $user_id, $book_id, $review, $rating, $rating_date);


    // Execute statement
    if ($stmt->execute()) {
        // Add query parameter to indicate successful review addition
        header("Location: ../discuss/discuss.php?reviewadded=successful");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
