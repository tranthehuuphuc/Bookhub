<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "connect.php";

        $user_id = $_SESSION["user_id"];
        $book_id = $_POST["book_id"];

        try {
            $sql = "DELETE FROM cart WHERE user_id = :user_id AND book_id = :book_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
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