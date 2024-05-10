<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start(); // Start session if not already started
    $user_id = $_SESSION["user_id"];
    $full_name = $_POST["full_name"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];

    // Prepare SQL statement to check if the user exists
    $sql_check = "SELECT * FROM userprofiles WHERE user_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // User profile exists, perform update
        $sql = "UPDATE userprofiles
                SET full_name = ?, address = ?, phone_number = ?
                WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $full_name, $address, $phone_number, $user_id); 
    } else {
        // User profile does not exist, perform insert
        $sql = "INSERT INTO userprofiles (user_id, full_name, address, phone_number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $full_name, $address, $phone_number); 
    }

    // Close connections
    $stmt_check->close();

    // Note: user_id is bound in the WHERE clause, not as a value to be updated
    $userUpdateStatus = "";

    // Execute statement
    if ($stmt->execute()) {
        $userUpdateStatus = "Profile updated successfully."; // Set success message
    } else {
        $userUpdateStatus = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to AccountSettings.php with success message in URL parameter
    header("Location: ../AccountSettings.php?userupdate=" . urlencode($userUpdateStatus));
    exit(); // Make sure to exit after redirection
}