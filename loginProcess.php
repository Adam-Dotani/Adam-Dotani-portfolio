<?php

session_start();
require_once 'db_connect.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    exit('Email and password are required.');
}

$stmt = $conn->prepare(
    'SELECT id, email, password FROM users WHERE email = ? LIMIT 1'
);

if (!$stmt) {
    error_log('Prepare failed: ' . $conn->error);
    exit('Unable to process the login.');
}

$stmt->bind_param('s', $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    exit('Incorrect email or password.');
}

session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];

header('Location: index.php');
exit;