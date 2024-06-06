<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    exit(json_encode(['error' => 'User not authenticated']));
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bookhub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    exit(json_encode(['error' => 'Database connection failed']));
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT books.book_id, books.title, books.cover_image, books.book_file
        FROM books
        JOIN mybooks ON books.book_id = mybooks.book_id
        WHERE mybooks.user_id = ? AND books.book_id = ?"; // Add condition to check if the book belongs to the user

$stmt = $conn->prepare($sql);
if (!$stmt) {
    http_response_code(500); // Internal Server Error
    exit(json_encode(['error' => 'Failed to prepare SQL statement']));
}

$requested_book_id = $_GET['book_id']; // Get the requested book_id from the URL

$stmt->bind_param("ii", $user_id, $requested_book_id);
if (!$stmt->execute()) {
    http_response_code(500); // Internal Server Error
    exit(json_encode(['error' => 'Failed to execute SQL statement']));
}

$result = $stmt->get_result();
if (!$result) {
    http_response_code(500); // Internal Server Error
    exit(json_encode(['error' => 'Failed to get result from SQL statement']));
}

$books = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

// Check if the requested book belongs to the user
if (count($books) > 0) {
    echo json_encode(['exists' => true, 'book' => $books[0]]); // Send the first book in the result set
} else {
    http_response_code(403); // Forbidden
    exit(json_encode(['error' => 'Requested book does not belong to the user']));
}
