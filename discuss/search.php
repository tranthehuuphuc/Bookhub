<?php
    include 'dbh.php'; // Include your database connection script

    // Fetch search query from GET request
    $searchQuery = $_GET['query'];

    $sql = "SELECT ratings.*, users.username
    FROM ratings 
    INNER JOIN users ON ratings.user_id = users.user_id 
    WHERE users.username LIKE '%$searchQuery%' OR ratings.review LIKE '%$searchQuery%'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<img src='".'./d_assets/user.png'."' alt='User Image' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>";
        echo "<p style='font-weight:800;font-size:1.5rem'><b>@".$row['username']."</b></p>";
        echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
        echo "<p>Review: ".$row['review']."</p>";
        echo "</div>";
        echo "<div style='width: 100%; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
    }
    } else {
    echo "No ratings found matching the search query.";
    }
