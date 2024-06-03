<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once 'connect.php';

        $user_id = $_SESSION['user_id'];
        $order_id = $_POST['order_id'];
        $book_id = $_POST['book_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        try {
            $sql = "INSERT INTO orderdetails (order_id, book_id, quantity, price) VALUES (:order_id, :book_id, :quantity, :price)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(['status' => 'success']);
            exit();
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            exit();
        }
    }
    else {
        echo json_encode(['status' => 'error', 'message' => 'Error: Invalid request']);
        exit();
    }
?>