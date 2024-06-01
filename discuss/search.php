<?php
    include 'dbh.php'; // Include your database connection script

    // Fetch search query from GET request
    $searchQuery = $_GET['query'];

    // Assuming $book_id holds the ID of the current book
    $book_id = $_SESSION['book_id']; // Assuming the book_id is stored in session

    $sql = "SELECT ratings.*, users.username, users.avatar
            FROM ratings 
            INNER JOIN users ON ratings.user_id = users.user_id 
            WHERE (users.username LIKE '%$searchQuery%' OR ratings.review LIKE '%$searchQuery%')
            AND ratings.book_id = $book_id";

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
            echo "<p style='font-weight:800;font-size:1.5rem'><b>@".$row['username']."</b></p>";
            echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
            echo "<p>Review: ".$row['review']."</p>";
            echo "</div>";
            echo "<div style='width: 100%; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
        }
    } else {
        echo "No ratings found matching the search query.";
    }
