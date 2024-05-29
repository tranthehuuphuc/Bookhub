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

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Tài khoản hoặc mật khẩu không đúng.";
        }

        if (is_username_wrong($result) || is_password_wrong($pwd, $result["password"])) {
            $errors["login_incorrect"] = "Tài khoản hoặc mật khẩu không đúng.";
        }

        require_once "config_session.php";
        
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../php/signup.php");
            die();
        }

        $newSessionID = session_create_id();
        $sessionID = $newSessionID . "_" . $result["user_id"];
        session_id($sessionID);

        $_SESSION["user_id"] = $result["user_id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_role"] = $result["role"]; // Save the user role in the session

        $_SESSION["last_regenerate"] = time();

        if ($result["role"] == "admin") {
            header("Location: ../../admin/admin.php");
        } else {
            header("Location: ../../Account/AccountSettings.html");
        }

        $pdo = null;
        $stmt = null;
        
        exit();
    }
    catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
}
else {
    header("Location: ../signin.php");
    exit();
}