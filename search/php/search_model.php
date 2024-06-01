<?php 

declare(strict_types=1);

function get_books(object $pdo, string $title): array {
    // $query = "SELECT * FROM books WHERE title = :title";
    // $stmt = $pdo->prepare($query);
    // $stmt->bindParam(":title", $title);
    // $stmt->execute();

    $query = "SELECT * FROM books WHERE title LIKE :title";
    $stmt = $pdo->prepare($query);
    $searchTitle = '%' . $title . '%'; // Adding wildcards for partial search
    $stmt->bindParam(":title", $searchTitle, PDO::PARAM_STR);
    $stmt->execute();

    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}