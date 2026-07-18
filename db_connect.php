<?php
/**
 * Creates a MySQL database connection.
 * Used across all blog-related PHP pages.
 */

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbPort = (int) (getenv('DB_PORT') ?: 3306);
$dbName = getenv('DB_NAME') ?: 'adam_portfolio_blog';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPassword = getenv('DB_PASSWORD') ?: '';

$conn = new mysqli(
    $dbHost,
    $dbUser,
    $dbPassword,
    $dbName,
    $dbPort
);


// Check connection
if ($db->connect_error) {
    die('Database connection failed: ' . $db->connect_error);
}

// Set character encoding (prevents text issues)
$db->set_charset('utf8mb4');