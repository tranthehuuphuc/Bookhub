<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once "connect.php";

        $user_id = $_SESSION["user_id"];

        try {
            $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(['status' => 'success', 'orders' => $orders]);
            exit();
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
            exit();
        } finally {
            $pdo = null;
        }
    }
?>