<?php
session_start(); // Start the session at the beginning
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "connect.php";

    $user_id = $_SESSION["user_id"];
    $current_pwd = $_POST["current_pwd"];
    $new_pwd = $_POST["new_pwd"];
    $confirm_pwd = $_POST["confirm_pwd"];

    if ($new_pwd !== $confirm_pwd) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu mới không khớp']);
        exit();
    }

    try {
        // Check if the current password is correct
        $sql_check = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($current_pwd, $result["password"])) {
                // Update the password
                $sql = "UPDATE users SET password = :password WHERE user_id = :user_id";
                $stmt = $pdo->prepare($sql);

                $option = [
                    'cost' => 12,
                ];
                $hashed_password = password_hash($new_pwd, PASSWORD_BCRYPT, $option);
                $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                $stmt->execute(); // Execute the query
                $stmt_check->closeCursor(); // Close the cursor

                echo json_encode(['status' => 'success', 'message' => 'Cập nhật mật khẩu thành công']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Mật khẩu hiện tại không chính xác']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy thông tin người dùng']);
            exit();
        }
    }
    catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
    exit();
}

$pdo = null; // Close the database connection
?>
