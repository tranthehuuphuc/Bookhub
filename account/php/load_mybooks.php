<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    require_once "connect.php";

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User ID không hợp lệ']);
        exit();
    }

    try {
        $sql = "SELECT book_id, cover_image, price, quantity FROM mybooks WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
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
?>
