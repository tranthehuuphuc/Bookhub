<?php
    header("Content-Type: application/json; charset=UTF-8");

    function respond($status, $message) {
        echo json_encode(['status' => $status, 'message' => $message]);
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];

        try {
            require_once 'dbh.php';
            require_once 'login_model.php';
            require_once 'login_contr.php';

            if (is_input_empty($username, $pwd)) {
                respond('error', 'Vui lòng điền đầy đủ thông tin.');
            }

            $result = get_user($pdo, $username);

            if (is_username_wrong($result) || is_password_wrong($pwd, $result["password"])) {
                respond('error', 'Tên đăng nhập hoặc mật khẩu không chính xác.');
            }

            // Start session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Regenerate session ID for security
            session_regenerate_id(true);

            // Set session variables
            $_SESSION["user_id"] = $result["user_id"];
            $_SESSION["user_username"] = htmlspecialchars($result["username"]);
            $_SESSION["user_role"] = $result["role"];
            $_SESSION["last_regenerate"] = time();

            // Redirect based on user role
            if ($result["role"] == "admin") {
                respond('success', 'admin');
            } else {
                respond('success', 'user');
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    } else {
        respond('error', 'Yêu cầu không hợp lệ');
    }
?>