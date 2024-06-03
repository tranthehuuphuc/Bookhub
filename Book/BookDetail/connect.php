<?php
    $dsn = "mysql:host=localhost;dbname=bookhub";
    $dbusername = "root";
    $dbpassword = "root";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    finally {
        $pdo = null;
    }
?>