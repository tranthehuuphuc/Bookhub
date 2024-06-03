<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Function to handle response
function respond($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    respond('error', 'Yêu cầu không hợp lệ');
}

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    respond('error', 'Không tìm thấy thông tin người dùng');
}

// Include the database connection
require_once "connect.php";

// Extract POST data and sanitize
$user_id = filter_var($_SESSION["user_id"], FILTER_SANITIZE_NUMBER_INT);
$book_id = filter_var($_POST["book_id"], FILTER_SANITIZE_NUMBER_INT);
$cover_image = filter_var($_POST["cover_image"], FILTER_SANITIZE_STRING);
$quantity = filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT);
$price = filter_var($_POST["price"], FILTER_SANITIZE_NUMBER_INT);

// Validate data
if (!$user_id || !$book_id || !$cover_image || !$quantity || !$price) {
    respond('error', 'Dữ liệu không hợp lệ');
}

try {
    // Check if the book is already in the cart
    $sql_check = "SELECT * FROM cart WHERE user_id = :user_id AND book_id = :book_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_check->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        respond('error', 'Sách đã có trong giỏ hàng');
    }

    // Insert the book into the cart
    $sql = "INSERT INTO cart (user_id, book_id, cover_image, quantity, price) VALUES (:user_id, :book_id, :cover_image, :quantity, :price)";

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    $stmt->execute();

    // Close the cursor
    $stmt_check->closeCursor();

    respond('success', 'Đã thêm sách vào giỏ hàng');
} 
catch (Exception $e) {
    respond('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
}
finally {
    $pdo = null;
}
?>
