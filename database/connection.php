<?php
$host     = 'localhost';
$dbName   = 'db_shegergebeya';
$username = 'root';
$password = '';

try {
    $dsn     = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    if ($e->getCode() == 1049) { 
        try {
            $dsnNoDb = "mysql:host=$host;charset=utf8mb4";
            $pdo = new PDO($dsnNoDb, $username, $password, $options);

            
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbName`");

           
            $tables = [
                "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    role ENUM('customer', 'company') NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )",
                "CREATE TABLE IF NOT EXISTS company (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    name VARCHAR(100) NOT NULL,
                    phone VARCHAR(20) NOT NULL UNIQUE,
                    address VARCHAR(255) DEFAULT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    CONSTRAINT company_user_fk FOREIGN KEY (user_id) REFERENCES users(id)
                )",
                "CREATE TABLE IF NOT EXISTS customers (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    firstname VARCHAR(100) NOT NULL,
                    middlename VARCHAR(100) NOT NULL,
                    lastname VARCHAR(100) NOT NULL,
                    phone VARCHAR(20) NOT NULL UNIQUE,
                    address VARCHAR(255) DEFAULT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    CONSTRAINT customer_user_fk FOREIGN KEY (user_id) REFERENCES users(id)
                )"
            ];

            foreach ($tables as $query) {
                $pdo->exec($query);
            }

        } catch (PDOException $ex) {
            die("Error creating database or tables: " . $ex->getMessage());
        }
    } else {
        die("Connection failed: " . $e->getMessage());
    }
}

?>
