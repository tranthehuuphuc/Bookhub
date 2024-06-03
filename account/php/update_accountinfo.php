<?php
    session_start(); // Start the session at the beginning
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "connect.php";

        if (!isset($_SESSION["user_id"])) {
            echo json_encode(['status' => 'error', 'message' => 'User is not logged in']);
            exit();
        }

        $user_id = $_SESSION["user_id"];
        $user_username = $_SESSION["user_username"];
        $fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : '';
        $username = isset($_POST["username"]) ? $_POST["username"] : $user_username; // Use session username if not provided
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
        $birthday = isset($_POST["birthday"]) ? $_POST["birthday"] : '';

        try {
            // Check if the account_info information already exists for the user
            $sql_check = "SELECT * FROM users WHERE user_id = :user_id";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Update the existing account_info information
                $sql = "UPDATE users SET fullname = :fullname, username = :username, email = :email, phone = :phone, birthday = :birthday WHERE user_id = :user_id";
            } else {
                // Insert new account_info information
                $sql = "INSERT INTO users (user_id, fullname, username, email, phone, birthday) VALUES (:user_id, :fullname, :username, :email, :phone, :birthday)";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            $stmt->execute(); // Execute the query
            $stmt_check->closeCursor(); // Close the cursor

            // Update session username if it was changed
            if ($username !== $user_username) {
                $_SESSION["user_username"] = $username;
            }

            echo json_encode(['status' => 'success', 'message' => 'Cập nhật thông tin tài khoản thành công']);
            exit();
        } 
        catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra']);
            exit();
        }

        $pdo = null; // Close the database connection
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        exit();
    }
?>
