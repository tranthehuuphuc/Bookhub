<?php
session_start(); // Start the session at the beginning
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect.php";

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

        if ($result) {
            // Update the existing shipping information
            $sql = "UPDATE shipping SET shipping_email = :shipping_email, shipping_phone = :shipping_phone, home_address = :home_address, ward = :ward, district = :district, city = :city WHERE user_id = :user_id";
        } else {
            // Insert new shipping information
            $sql = "INSERT INTO shipping (user_id, shipping_email, shipping_phone, home_address, ward, district, city) VALUES (:user_id, :shipping_email, :shipping_phone, :home_address, :ward, :district, :city)";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':shipping_email', $shipping_email, PDO::PARAM_STR);
        $stmt->bindParam(':shipping_phone', $shipping_phone, PDO::PARAM_STR);
        $stmt->bindParam(':home_address', $home_address, PDO::PARAM_STR);
        $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
        $stmt->bindParam(':district', $district, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);

        $stmt->execute(); // Execute the query
        $stmt_check->closeCursor(); // Close the cursor

        echo json_encode(['status' => 'success', 'message' => 'Cập nhật thông tin giao hàng thành công']);
        exit();
    } 
    catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        exit();
    }

    $pdo = null; // Close the database connection
}
?>
