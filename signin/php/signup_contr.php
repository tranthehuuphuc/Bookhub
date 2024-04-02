<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd, string $email) {
    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    }
    return false;
}

function is_email_inavlid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)) {
        return true;
    }
    return false;
}

function is_email_registered(object $pdo, string $email) {
    if (get_email($pdo, $email)) {
        return true;
    }
    return false;
}

function create_user(object $pdo, string $username, string $email, string $pwd) {
    set_user($pdo,$username,$email,$pwd);
}