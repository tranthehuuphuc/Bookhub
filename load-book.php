<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

require_once "./account/php/connect.php";

try {
    // Updated SQL query to fetch the top 4 most ordered books
    $sql = "
        SELECT books.book_id, books.cover_image, books.rating, books.price, SUM(orderdetails.quantity) AS total_quantity
        FROM books
        JOIN orderdetails ON books.book_id = orderdetails.book_id
        GROUP BY books.book_id, books.cover_image, books.rating, books.price
        ORDER BY total_quantity DESC
        LIMIT 4
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $mybook = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($mybook) {
        echo json_encode(['status' => 'success', 'mybook' => $mybook]);
    } else {
        echo json_encode(['status' => 'success', 'mybook' => []]);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
}
