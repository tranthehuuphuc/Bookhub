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

    // Get user ID and passwords from the POST data
    $user_id = $_SESSION["user_id"];
    $current_pwd = $_POST["current_pwd"];
    $new_pwd = $_POST["new_pwd"];
    $confirm_pwd = $_POST["confirm_pwd"];

    // Check if the new passwords match
    if ($new_pwd !== $confirm_pwd) {
        respond('error', 'Mật khẩu mới không khớp');
    }

    try {
        // Check if the current password is correct
        $sql_check = "SELECT password FROM users WHERE user_id = :user_id";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

        // Verify the current password
        if ($result && password_verify($current_pwd, $result["password"])) {
            // Update the password
            $sql = "UPDATE users SET password = :password WHERE user_id = :user_id";
            $stmt = $pdo->prepare($sql);

            // Hash the new password
            $hashed_password = password_hash($new_pwd, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            $stmt->execute(); // Execute the query
            $stmt_check->closeCursor(); // Close the cursor

            respond('success', 'Cập nhật mật khẩu thành công');
        } else {
            respond('error', 'Mật khẩu hiện tại không chính xác');
        }
    } catch (PDOException $e) {
        respond('error', 'Có lỗi xảy ra');
    }
?>
