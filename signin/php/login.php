<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];

        try {
            require_once 'dbh.php';
            require_once 'login_model.php';
            require_once 'login_contr.php';

            // ERROR HANDLERS
            $errors = [];

            if (is_input_empty($username, $pwd)) {
                $errors["empty_input"] = "Hãy nhập tất cả các ô.";
            }

            $result = get_user($pdo, $username);

            if (is_username_wrong($result) || is_password_wrong($pwd, $result["password"])) {
                $errors["login_incorrect"] = "Tài khoản hoặc mật khẩu không đúng.";
            }

            if ($errors) {
                $_SESSION["errors_login"] = $errors;
                header("Location: ../php/signup.php");
                exit();
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
                header("Location: ../../admin/admin.php");
            } else {
                header("Location: ../../account/profile.php");
            }

            exit();
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    } else {
        header("Location: ../signin.php");
        exit();
    }
?>