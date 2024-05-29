<?php
require '../admin/dbh.php';

$author_name = $_POST['author_name'];
$birth_date = $_POST['birth_date'];
$nationality = $_POST['nationality'];
$biography = $_POST['biography'];

$sql = "INSERT INTO authors (author_name, birth_date, nationality, biography) 
        VALUES ('$author_name', '$birth_date', '$nationality', '$biography')";

if ($conn->query($sql) === TRUE) {
    echo "New author added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Assuming the dashboard URL is 'dashboard.php'
$dashboard_url = './admin.php';

// Redirect to the dashboard with success message
header("Location: $dashboard_url?success=1");
exit;
