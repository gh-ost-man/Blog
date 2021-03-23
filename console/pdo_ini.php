<?php
    require_once '../config/config.php';

    try {
        $pdo = new \PDO(
            sprintf("mysql::host=%s; dbname=%s", SERVER_NAME, DB_NAME),
            USER_NAME,
            PASSWORD
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        die("Connected failed: " . $e->getMessage());
    }