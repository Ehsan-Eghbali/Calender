<?php
define('DB_HOST', 'mysql');
define('DB_PORT', '3306');
define('DB_NAME', 'appointment_db');
define('DB_USERNAME', 'saba');
define('DB_PASSWORD', 'idea');

function connectDatabase() {
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    try {
        return new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}
?>