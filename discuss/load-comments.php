<?php
include 'dbh.php';

// Assuming you have started the session already
session_start();

// Retrieve the book_id from the session
$book_id = $_SESSION['book_id'];

$commentNewCount = $_POST['commentNewCount'];

// Modify the SQL query to use the book_id from the session
$sql = "SELECT ratings.*, users.username, users.avatar
        FROM ratings 
        INNER JOIN users ON ratings.user_id = users.user_id 
        WHERE ratings.book_id = $book_id
        LIMIT $commentNewCount";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        // Display user avatar if available, else use default avatar
        if (!empty($row['avatar'])) {
            echo "<img src='" . htmlspecialchars($row['avatar']) . "' alt='User Avatar' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
        } else {
            echo "<img src='./d_assets/user.png' alt='User Avatar' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
        }
        echo "<p style='font-weight:800;font-size:1.5rem'>@".$row['username']."</p>";
        echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
        echo "<p>Review: ".$row['review']."</p>";
        echo "</div>";
        echo "<div style='width: 100%; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
    }
} else {
    echo "Không có bình luận nào.";
}
