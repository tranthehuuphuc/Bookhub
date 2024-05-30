<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once "../admin/dbh.php";

    // Get the form data
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $categories = $_POST['categories']; // Array of category IDs
    $publication_year = $_POST['publication_year'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $pages = $_POST['pages'];
    $language = $_POST['language'];
    $format = $_POST['format'];
    $isbn = $_POST['isbn'];
    $chapters = $_POST['chapters'];

    // Upload the cover image
    $cover_image = $_FILES['cover_image']['name'];
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($cover_image);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);
    } else {
        echo "File is not an image.";
        exit;
    }

    // Insert book details into the database
    $sql = "INSERT INTO books (title, author_id, publication_year, price, available_quantity, description, cover_image, rating)
            VALUES ('$title', '$author_id', '$publication_year', '$price', '$quantity', '$description', '$cover_image', 0)";
    if ($conn->query($sql) === TRUE) {
        // Get the ID of the inserted book
        $book_id = $conn->insert_id;

        // Insert additional book information into the database
        $sql_info = "INSERT INTO book_information (book_id, number_of_pages, language, format, isbn, chapters)
                     VALUES ('$book_id', '$pages', '$language', '$format', '$isbn', '$chapters')";
        $conn->query($sql_info);

        // Insert book-category associations into the database
        foreach ($categories as $category_id) {
            $sql_category = "INSERT INTO book_categories (book_id, category_id) VALUES ('$book_id', '$category_id')";
            $conn->query($sql_category);
        }

        // Parse chapters and insert each chapter into the book_chapters table
        $chapter_list = explode("\n", $chapters);
        foreach ($chapter_list as $chapter_title) {
            $chapter_title = trim($chapter_title); // Remove any extra whitespace
            if (!empty($chapter_title)) {
                $sql_chapter = "INSERT INTO book_chapters (book_id, chapter_title) VALUES ('$book_id', '$chapter_title')";
                $conn->query($sql_chapter);
            }
        }

        // Redirect to the dashboard with success message
        header("Location: admin.php?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
