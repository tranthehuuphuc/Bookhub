<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "connect.php";
        $user_id = $_SESSION["user_id"];
        $home_number = $_POST["home_number"];
        $ward = $_POST["ward"];
        $district = $_POST["district"];
        $city = $_POST["city"];
        $shipping_phone = $_POST["shipping_phone"];
        $shipping_email = $_POST["shipping_email"];

        $sql_check = "SELECT * FROM shipping WHERE user_id = ?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bind_param("i", $user_id);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $sql = "UPDATE shipping SET shipping_email = ?, shipping_phone = ?, home_number = ?, ward = ?, district = ?, city = ? WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bind_param("ssssssi", $shipping_email, $shipping_phone, $home_number, $ward, $district, $city, $user_id);
        } else {
            $sql = "INSERT INTO shipping (user_id, shipping_email, shipping_phone, home_number, ward, district, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bind_param("isssssi", $user_id, $shipping_email, $shipping_phone, $home_number, $ward, $district, $city);
        }

        $stmt_check->close();

        $stmt->close();
        $pdo->close();

        header("Location: ../profile.php");
        exit();
    }
?>
