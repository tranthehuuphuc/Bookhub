<?php

declare(strict_types=1);

/**
 * Retrieve book information from the database based on the book ID.
 *
 * @param PDO $pdo The PDO object connected to the database.
 * @param int $bookId The ID of the book to retrieve.
 * @return array|null Returns an array of book information if found, or null if not found.
 * @throws PDOException If an error occurs during the database query execution.
 */
function get_book_by_id(PDO $pdo, int $bookId): ?array {
    try {
        // Prepare and execute the SQL query
        $query = "SELECT * FROM books WHERE book_id = :bookId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":bookId", $bookId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the result or null if no book found
        return $result ? $result : null;
    } catch (PDOException $e) {
        // Handle database errors
        // You can log the error, return a specific error message, or re-throw the exception
        throw $e;
    }
}
