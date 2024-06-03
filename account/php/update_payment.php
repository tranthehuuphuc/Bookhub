<?php
    session_start(); // Start the session at the beginning
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "connect.php";

        $user_id = $_SESSION["user_id"];
        $payment_email = $_POST["payment_email"];
        $payment_phone = $_POST["payment_phone"];

        try {
            // Check if the payment information already exists for the user
            $sql_check = "SELECT * FROM payment WHERE user_id = :user_id";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Update the existing payment information
                $sql = "UPDATE payment SET payment_email = :payment_email, payment_phone = :payment_phone WHERE user_id = :user_id";
            } else {
                // Insert new payment information
                $sql = "INSERT INTO payment (user_id, payment_email, payment_phone) VALUES (:user_id, :payment_email, :payment_phone)";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':payment_email', $payment_email, PDO::PARAM_STR);
            $stmt->bindParam(':payment_phone', $payment_phone, PDO::PARAM_STR);

            $stmt->execute(); // Execute the query
            $stmt_check->closeCursor(); // Close the cursor

            echo json_encode(['status' => 'success', 'message' => 'Cập nhật thông tin thanh toán thành công']);
            exit();
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra']);
            exit();
        }

        $pdo = null; // Close the database connection
    }
?>
