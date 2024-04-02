<?php

declare(strict_types=1);

function check_signup_errors() {
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];

        echo " ";
        foreach ($errors as $error) {
            echo '<p class="form_error" style="color: red;font-size:0.8vw">'. $error .'</p>';
        }
        unset($_SESSION["errors_signup"]);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form_success">Đăng ký thành công</p>';
    }
}