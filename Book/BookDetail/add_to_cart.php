<?php
    session_start();
    header("Content-Type: application/json; charset=UTF-8");

    function respond($status, $message) {
        echo json_encode(['status' => $status, 'message' => $message]);
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        respond('error', 'Yêu cầu không hợp lệ');
    }

    if (!isset($_SESSION["user_id"])) {
        respond('no_user', 'Hãy đăng nhập trước khi thêm sách vào giỏ hàng');
    }

    require_once "connect.php";

    $user_id = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
    $book_id = filter_var($_POST["book_id"], FILTER_SANITIZE_NUMBER_INT);
    $cover_image = filter_var($_POST["cover_image"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);

    if (!$user_id || !$book_id || !$cover_image || !$quantity || !$price) {
        respond('error', 'Dữ liệu không hợp lệ');
    }

    try {
        $sql_check = "SELECT * FROM cart WHERE user_id = :user_id AND book_id = :book_id";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            respond('error', 'Sách đã có trong giỏ hàng');
        }

        $sql = "INSERT INTO cart (user_id, book_id, cover_image, quantity, price) VALUES (:user_id, :book_id, :cover_image, :quantity, :price)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->execute();

        $stmt_check->closeCursor();

        respond('success', 'Đã thêm sách vào giỏ hàng');
    } catch (Exception $e) {
        respond('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
?>
