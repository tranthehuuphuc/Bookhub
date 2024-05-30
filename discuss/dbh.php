<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookhub";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Set the character set to utf8mb4
$conn->set_charset("utf8mb4");