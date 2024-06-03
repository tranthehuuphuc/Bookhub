<?php

// Định nghĩa hàm kiểm tra check_function
function check_function($result): bool {
    if ($result === true) {
        return true;
    } elseif ($result === false) {
        return false;
    } else {
        return false;
    }
}