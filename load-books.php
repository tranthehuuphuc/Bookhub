<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    require_once "./account/php/connect.php";

    try {
        $sql = "SELECT book_id, cover_image,rating, price FROM books ORDER BY book_id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $mybooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($mybooks) {
            echo json_encode(['status' => 'success', 'mybooks' => $mybooks]);
        } else {
            echo json_encode(['status' => 'success', 'mybooks' => []]);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
    }
