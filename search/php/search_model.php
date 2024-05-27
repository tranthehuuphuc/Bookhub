<?php 

declare(strict_types=1);

function get_books(object $pdo, string $title): array {
    $query = "SELECT * FROM books WHERE title = :title";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->execute();

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}