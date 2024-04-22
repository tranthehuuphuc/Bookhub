<?php
// Include your database connection script
include '../discuss/dbh.php';
// Fetch book data from the database
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

// Prepare book data as an array
$books = array();
while ($row = mysqli_fetch_assoc($result)) {
    // Append each row as a book object to the $books array
    $books[] = array(
        'title' => $row['title'],
        'author' => $row['author'],
        'description' => $row['description'],
        'category' => $row['category'],
        'publication_year' => $row['publication_year'],
        'publisher' => $row['publisher'],
        'price' => $row['price'],
        'available_quantity' => $row['available_quantity'],
        'cover_image' => $row['cover_image'],
        'rating' => $row['rating']
    );
}

// Output book data as JSON
header('Content-Type: application/json');
echo json_encode($books);