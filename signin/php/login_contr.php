<?php 

declare(strict_types=1);

function is_input_empty($username, $pwd) {
    if (empty($username) || empty($pwd)) {
        return true;
    }
    return false;
}

function is_username_wrong(bool|array $result) {
    if (!$result) {
        return true;
    }
    return false;
}

function is_password_wrong(string $pwd, string $hashedPwd) {
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    }
    return false;
}