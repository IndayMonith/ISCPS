<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
    require_once('ssp.class.php');
    $database = 'iscps';
    $username = 'root';
    $password = '';
    $host = 'localhost';
    $db = new PDO("mysql:host=$host", $username, $password);
    $query = "CREATE DATABASE IF NOT EXISTS $database";

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec($query);
        $db->exec("USE $database");

        $db->exec("
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `username` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL
            );
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS `sensors` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `sensor_name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        $db->exec("
            CREATE TABLE IF NOT EXISTS `slots` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `sensor_id` INT,
                `name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (`sensor_id`) REFERENCES `sensors`(`id`) ON DELETE CASCADE
            );
        ");

        $db->exec("
            CREATE TABLE IF NOT EXISTS `logs` (
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `slot_id` INT,
                `time_in` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `time_out` DATETIME,
                `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (`slot_id`) REFERENCES `slots`(`id`) ON DELETE CASCADE
            );
        ");

        $db->beginTransaction();

        $stmt = $db->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = 'admin'");
        $stmt->execute();
        $userExists = $stmt->fetchColumn();
        
        if (!$userExists) {
            $stmt = $db->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)");
            $stmt->bindValue(':username', 'admin');
            $stmt->bindValue(':password', '$2y$10$WgL2d2fzi6IiGiTfXvdBluTLlMroU8zBtIcRut7SzOB6j9i/LbA4K');
            $stmt->execute();
        }
        
        $db->commit();

    } catch(PDOException $e) {
        die("Error creating database: " . $e->getMessage());
    }
?>