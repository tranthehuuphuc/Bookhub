<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {

        require_once "dbh.php";
        require_once "signup_model.php";
        require_once "signup_contr.php";

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Hãy nhập tất cả các ô.";
        }

        if (is_email_inavlid($email)) {
            $errors["invalid_email"] = "Email không đúng.";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Tên người dùng đã tồn tại.";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_rused"] = "Email đã tồn tại.";
        }

        require_once "config_session.php";
        
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_Data"] = $signupData;

            header("Location: ../php/signup.php");
            die();
        }

        create_user($pdo, $username, $email, $pwd);

        header("Location: ../signin.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $e) {
        die("Query failed: ". $e->getMessage());
    }
} else {
    header("Location: ../signin.php");
    exit(); // Stop further execution
}