<?php 

declare(strict_types=1);

function check_input(bool|array $result): bool {
    if (is_array($result) && empty($result)) {
        return false;
    }
    return true;
}