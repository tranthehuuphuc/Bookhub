<?php
    session_start(); // Start the session at the beginning

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "connect.php";

        $user_id = $_SESSION["user_id"];
        $home_number = $_POST["home_number"];
        $ward = $_POST["ward"];
        $district = $_POST["district"];
        $city = $_POST["city"];
        $shipping_phone = $_POST["shipping_phone"];
        $shipping_email = $_POST["shipping_email"];

        try {
            // Check if the shipping information already exists for the user
            $sql_check = "SELECT * FROM shipping WHERE user_id = :user_id";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_check->execute();
            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Update the existing shipping information
                $sql = "UPDATE shipping SET shipping_email = :shipping_email, shipping_phone = :shipping_phone, home_number = :home_number, ward = :ward, district = :district, city = :city WHERE user_id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':shipping_email', $shipping_email, PDO::PARAM_STR);
                $stmt->bindParam(':shipping_phone', $shipping_phone, PDO::PARAM_STR);
                $stmt->bindParam(':home_number', $home_number, PDO::PARAM_STR);
                $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
                $stmt->bindParam(':district', $district, PDO::PARAM_STR);
                $stmt->bindParam(':city', $city, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            } else {
                // Insert new shipping information
                $sql = "INSERT INTO shipping (user_id, shipping_email, shipping_phone, home_number, ward, district, city) VALUES (:user_id, :shipping_email, :shipping_phone, :home_number, :ward, :district, :city)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':shipping_email', $shipping_email, PDO::PARAM_STR);
                $stmt->bindParam(':shipping_phone', $shipping_phone, PDO::PARAM_STR);
                $stmt->bindParam(':home_number', $home_number, PDO::PARAM_STR);
                $stmt->bindParam(':ward', $ward, PDO::PARAM_STR);
                $stmt->bindParam(':district', $district, PDO::PARAM_STR);
                $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            }

            $stmt->execute(); // Execute the query
            $stmt_check->closeCursor(); // Close the cursor
            header("Location: ../profile.php"); // Redirect to the profile page
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $pdo = null; // Close the database connection
    }