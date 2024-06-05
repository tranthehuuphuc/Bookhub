<?php 
include './admin/dbh.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $email = $conn->real_escape_string($_POST['email']);

    // Check if the email is already subscribed
    $check_query = "SELECT COUNT(*) AS count FROM subscribe_list WHERE email = '$email'";
    $result = $conn->query($check_query);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        echo 'subscribed';
    } else {
        // Attempt insert query execution
        $sql = "INSERT INTO subscribe_list (email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}

// Close connection
$conn->close();
