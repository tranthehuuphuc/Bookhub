<?php
declare(strict_types=1);

function get_books(PDO $pdo, string $title = '', string $category = '', string $author = '', string $publisher = ''): array {
    $sql = "SELECT books.*, GROUP_CONCAT(book_categories.category_id) AS category_ids
            FROM books
            LEFT JOIN book_categories ON books.book_id = book_categories.book_id
            WHERE 1";

    if ($title) {
        $sql .= " AND books.title LIKE :title";
    }
    if ($category) {
        $sql .= " AND book_categories.category_id = :category";
    }
    if ($author) {
        $sql .= " AND books.author_id = :author";
    }
    if ($publisher) {
        $sql .= " AND books.publisher = :publisher";
    }

    $sql .= " GROUP BY books.book_id"; // Grouping by book ID

    $stmt = $pdo->prepare($sql);

    if ($title) {
        $searchTitle = '%' . $title . '%';
        $stmt->bindParam(':title', $searchTitle, PDO::PARAM_STR);
    }
    if ($category) {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    }
    if ($author) {
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    }
    if ($publisher) {
        $stmt->bindParam(':publisher', $publisher, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$title = urldecode($_GET['search'] ?? ''); // Get and decode search term
$category = urldecode($_GET['category'] ?? '');
$author = urldecode($_GET['author'] ?? '');
$publisher = urldecode($_GET['publisher'] ?? '');

$dsn = "mysql:host=localhost;dbname=bookhub;charset=utf8mb4";
$pdo = new PDO($dsn, 'root', 'root');
$books = get_books($pdo, $title, $category, $author, $publisher);
