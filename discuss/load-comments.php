<?php
    include 'dbh.php';
    $commentNewCount = $_POST['commentNewCount'];

    $sql = "SELECT ratings.*, users.username
    FROM ratings 
    INNER JOIN users ON ratings.user_id = users.user_id 
    LIMIT $commentNewCount";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<img src='".'./d_assets/user.png'."' alt='User Image' style='width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;'>"; // Display user image
            echo "<p style='font-weight:800;font-size:1.5rem'>@".$row['username']."</p>";
            echo "<p><i>Rating: ".$row['rating'].'/5.00'."</i></p>";
            echo "<p>Review: ".$row['review']."</p>";
            echo "</div>";
            echo "<div style='width: 100%; height: 0.1vw; background-color: #F08A5D;margin-bottom: 1vw;'></div>";
        }
    } else {
        echo "Không có bình luận nào.";
    }