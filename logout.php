<?php
/**
 * Logs the user out by destroying the session
 * and redirecting back to the home page.
 */

session_start();

// Remove all session variables
$_SESSION = [];

// Destroy the session cookie if it exists
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy the session completely
session_destroy();

// Redirect to homepage
header('Location: index.php');
exit();
?>