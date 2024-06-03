<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once "connect.php";

        $user_id = $_SESSION["user_id"];

        try {
            $sql = "SELECT * FROM cart WHERE user_id = :user_id ORDER BY cart_date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(['status' => 'success', 'cart' => $cart]);
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