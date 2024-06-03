<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    require_once "connect.php";

    if (isset($_GET["order_id"])) {
        $order_id = $_GET["order_id"];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Order ID không hợp lệ']);
        exit();
    }

    try {
        $sql = "SELECT order_id, book_id, quantity, price, cover_image FROM orderdetails WHERE order_id = :order_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        $order_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($order_details) {
            echo json_encode(['status' => 'success', 'order_details' => $order_details]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy chi tiết đơn hàng']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
    }
?>