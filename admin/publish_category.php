<?php
require '../admin/dbh.php';

$category_name = $_POST['category_name'];

$sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";

if ($conn->query($sql) === TRUE) {
    echo "New category added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Assuming the dashboard URL is 'dashboard.php'
$dashboard_url = './admin.php';

// Redirect to the dashboard with success message
header("Location: $dashboard_url?success=1");
exit;
