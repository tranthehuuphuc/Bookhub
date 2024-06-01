<?php
// Include your database connection script
include '../discuss/dbh.php';
// Fetch book data from the database
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
