<?php
    header("Content-Type: application/json; charset=UTF-8");

    function respond($status, $message) {
        echo json_encode(['status' => $status, 'message' => $message]);
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        $email = $_POST["email"];

        try {

            require_once "dbh.php";
            require_once "signup_model.php";
            require_once "signup_contr.php";

            if (is_input_empty($username, $pwd, $email)) {
                respond('error', 'Vui lòng điền đầy đủ thông tin.');
            }

            if (is_email_inavlid($email)) {
                respond('error', 'Email không hợp lệ.');
            }

            if (is_username_taken($pdo, $username)) {
                respond('error', 'Tên đăng nhập đã tồn tại.');
            }
            if (is_email_registered($pdo, $email)) {
                respond('error', 'Email đã được đăng ký.');
            }

            require_once "config_session.php";

            create_user($pdo, $username, $email, $pwd);

            respond('success', 'Đăng ký thành công!');
        } catch (PDOException $e) {
            respond('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    } else {
        respond('error', 'Yêu cầu không hợp lệ');
    }
?>