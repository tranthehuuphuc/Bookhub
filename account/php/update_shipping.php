<?php
session_start(); // Start the session at the beginning
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

// Extract POST data
$user_id = $_SESSION["user_id"];
$shipping_email = $_POST["shipping_email"];
$shipping_phone = $_POST["shipping_phone"];
$home_address = $_POST["home_address"];
$ward = $_POST["ward"];
$district = $_POST["district"];
$city = $_POST["city"];

try {
    // Check if the shipping information already exists for the user
    $sql_check = "SELECT * FROM shipping WHERE user_id = :user_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    // Decide whether to insert or update based on the result
    if ($result) {
        $sql = "UPDATE shipping SET shipping_email = :shipping_email, shipping_phone = :shipping_phone, home_address = :home_address, ward = :ward, district = :district, city = :city WHERE user_id = :user_id";
    } else {
        $sql = "INSERT INTO shipping (user_id, shipping_email, shipping_phone, home_address, ward, district, city) VALUES (:user_id, :shipping_email, :shipping_phone, :home_address, :ward, :district, :city)";
    }

    // Prepare and execute the statement
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':shipping_email', $shipping_email, PDO::PARAM_STR);
    $stmt->bindParam(':shipping_phone', $shipping_phone, PDO::PARAM_STR);
    $stmt->bindParam(':home_address', $home_address, PDO::PARAM_STR);
    $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
    $stmt->bindParam(':district', $district, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->execute();

    // Close the cursor
    $stmt_check->closeCursor();

    respond('success', 'Cập nhật thông tin giao hàng thành công');
} catch (PDOException $e) {
    respond('error', 'Có lỗi xảy ra: ' . $e->getMessage());
} finally {
    $pdo = null; // Close the database connection
}
?>
