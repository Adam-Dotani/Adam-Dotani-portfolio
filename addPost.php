<?php
session_start();

/**
 * Handles the blog post form from addEntry.php.
 * Only logged-in users can add posts.
 */

if (empty($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: addEntry.php');
    exit();
}

require_once __DIR__ . '/db_connect.php';

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

if ($title === '' || $content === '') {
    header('Location: addEntry.php');
    exit();
}

$created_at = date('Y-m-d H:i:s');

/**
 * Prepared statement:
 * The ? placeholders are replaced safely with the form values.
 */
$stmt = $db->prepare(
    'INSERT INTO posts (title, content, created_at) VALUES (?, ?, ?)'
);

if (!$stmt) {
    die('Could not prepare the database query.');
}

$stmt->bind_param('sss', $title, $content, $created_at);

if ($stmt->execute()) {
    $stmt->close();
    header('Location: viewBlog.php');
    exit();
}

$stmt->close();
die('Could not save the post. Check the database connection.');
?>