<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once "../admin/dbh.php";

    // Validate and get the form data
    $title = trim($_POST['title']);
    $author_id = (int)$_POST['author_id'];
    $categories = $_POST['categories'] ?? []; // Array of category IDs
    $publication_year = trim($_POST['publication_year']);
    $publisher = trim($_POST['publisher']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $description = trim($_POST['description']);
    $pages = (int)$_POST['pages'];
    $language = trim($_POST['language']);
    $format = trim($_POST['format']);
    $isbn = trim($_POST['isbn']);
    $chapters = trim($_POST['chapters']);

    // Upload the cover image
    $cover_image = $_FILES['cover_image']['name'];
    $target_dir = "../admin/uploads/";
    $target_file = $target_dir . basename($cover_image);

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
    } else {
        echo "<script>alert('File is not an image.'); window.location.href = 'admin.php';</script>";
        exit;
    }

    // Upload the book file
    $target_dir = "../admin/files/";
    $book_file = $_FILES['book_file']['name'];
    $target_book_file = $target_dir . basename($book_file);

    if (move_uploaded_file($_FILES["book_file"]["tmp_name"], $target_book_file)) {
        // File uploaded successfully
    } else {
        echo "<script>alert('Failed to upload book file.'); window.location.href = 'admin.php';</script>";
        exit;
    }

    // Check if the book already exists
    $sql_check = "SELECT * FROM books WHERE title = ? AND author_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $title, $author_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        echo "<script>alert('Failed. Book already exists.'); window.location.href = 'admin.php';</script>";
        exit;
    } else {
        // Insert new book
        $sql = "INSERT INTO books (title, author_id, publication_year, publisher, price, available_quantity, description, cover_image, book_file, rating)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissdisss", $title, $author_id, $publication_year, $publisher, $price, $quantity, $description, $cover_image, $book_file);
        if ($stmt->execute()) {
            $book_id = $stmt->insert_id;

            // Insert additional book information
            $sql_info = "INSERT INTO book_information (book_id, number_of_pages, language, format, isbn, chapters)
                         VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_info = $conn->prepare($sql_info);
            $stmt_info->bind_param("iissss", $book_id, $pages, $language, $format, $isbn, $chapters);
            $stmt_info->execute();

            // Insert chapters
            if (!empty($chapters)) {
                $chaptersArray = explode("\n", $chapters);
                foreach ($chaptersArray as $chapter) {
                    $chapter = trim($chapter);
                    if (!empty($chapter)) {
                        $sql_insert_chapter = "INSERT INTO book_chapters (book_id, chapter_title) VALUES (?, ?)";
                        $stmt_insert_chapter = $conn->prepare($sql_insert_chapter);
                        $stmt_insert_chapter->bind_param("is", $book_id, $chapter);
                        $stmt_insert_chapter->execute();
                    }
                }
            }

            // Insert book-category associations
            foreach ($categories as $category_id) {
                $sql_category = "INSERT INTO book_categories (book_id, category_id) VALUES (?, ?)";
                $stmt_category = $conn->prepare($sql_category);
                $stmt_category->bind_param("ii", $book_id, $category_id);
                $stmt_category->execute();
            }

            echo "<script>alert('Book added successfully.'); window.location.href = 'admin.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statements and database connection
    $stmt_check->close();
    $stmt->close();
    $stmt_info->close();
    $stmt_category->close();
    $conn->close();
}
