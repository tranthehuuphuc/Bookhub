<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect.php";

    if (!isset($_SESSION["user_id"])) {
        echo json_encode(['status' => 'error', 'message' => 'Người dùng không đăng nhập']);
        exit();
    }

    $user_id = $_SESSION["user_id"];
    $order_date = date("Y-m-d");
    $input = json_decode(file_get_contents('php://input'), true);
    $sum_price = filter_var($input["sum_price"], FILTER_SANITIZE_NUMBER_INT);
    $order_status = "Hoàn thành";
    $orderdetails = $input["orderdetails"];

    try {
        $sql = "INSERT INTO orders (user_id, order_date, sum_price, order_status) VALUES (:user_id, :order_date, :sum_price, :order_status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $stmt->bindParam(':sum_price', $sum_price, PDO::PARAM_INT);
        $stmt->bindParam(':order_status', $order_status, PDO::PARAM_STR);
        $stmt->execute();

        $order_id = $pdo->lastInsertId();

        foreach ($orderdetails as $orderdetail) {
            $book_id = filter_var($orderdetail["book_id"], FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_var($orderdetail["quantity"], FILTER_SANITIZE_NUMBER_INT);
            $price = filter_var($orderdetail["price"], FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT cover_image FROM books WHERE book_id = :book_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $stmt->execute();
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($book) {
                $cover_image = $book["cover_image"];

                $sql = "INSERT INTO orderdetails (order_id, book_id, quantity, price, cover_image) VALUES (:order_id, :book_id, :quantity, :price, :cover_image)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':price', $price, PDO::PARAM_INT);
                $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_STR);
                $stmt->execute();

                $sql = "INSERT INTO mybooks (user_id, book_id, cover_image, price, quantity) VALUES (:user_id, :book_id, :cover_image, :price, :quantity)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
                $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_STR);
                $stmt->bindParam(':price', $price, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->execute();
            }
            else {
                echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy sách']);
                exit();
            }
        }

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit();
}
?>
