<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1900,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Lax',
]);

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["last_regenerate"])) {
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regenerate"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION["last_regenerate"])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regenerate"] >= $interval) {
            regenerate_session_id();
        }
    }
}

function regenerate_session_id() {
    session_regenerate_id(true); // Regenerate session ID
    $_SESSION["last_regenerate"] = time(); // Update regeneration timestamp
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true); // Regenerate session ID
    $_SESSION["last_regenerate"] = time(); // Update regeneration timestamp
}
