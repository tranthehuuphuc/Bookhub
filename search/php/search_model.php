<?php
declare(strict_types=1);

function get_books(PDO $pdo, string $title = '', int $category_id = 0, int $author_id = 0, string $publisher = ''): array {
    $sql = "SELECT books.*, GROUP_CONCAT(book_categories.category_id) AS category_ids,
                   authors.author_id, authors.author_name,
                   GROUP_CONCAT(book_information.language) AS languages,
                   GROUP_CONCAT(book_information.format) AS formats
            FROM books
            LEFT JOIN book_categories ON books.book_id = book_categories.book_id
            LEFT JOIN authors ON books.author_id = authors.author_id
            LEFT JOIN book_information ON books.book_id = book_information.book_id
            WHERE 1=1";

    if ($title) {
        $sql .= " AND books.title LIKE :title";
    }
    if ($category_id) {
        $sql .= " AND book_categories.category_id = :category_id";
    }
    if ($author_id) {
        $sql .= " AND books.author_id = :author_id";
    }
    if ($publisher) {
        $sql .= " AND books.publisher LIKE :publisher";
    }

    $sql .= " GROUP BY books.book_id";

    $stmt = $pdo->prepare($sql);

    if ($title) {
        $searchTitle = '%' . $title . '%';
        $stmt->bindParam(':title', $searchTitle, PDO::PARAM_STR);
    }
    if ($category_id) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    }
    if ($author_id) {
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
    }
    if ($publisher) {
        $searchPublisher = '%' . $publisher . '%';
        $stmt->bindParam(':publisher', $searchPublisher, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Get and decode search parameters
$title = urldecode($_GET['search'] ?? '');
$category_id = isset($_GET['category']) ? (int)urldecode($_GET['category']) : 0;
$author_id = isset($_GET['author']) ? (int)urldecode($_GET['author']) : 0;
$publisher = urldecode($_GET['publisher'] ?? '');


// Set up database connection
$dsn = "mysql:host=localhost;dbname=bookhub;charset=utf8mb4";
$pdo = new PDO($dsn, 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$books = get_books($pdo, $title, $category_id, $author_id, $publisher);