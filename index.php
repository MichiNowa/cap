<?php

// this page serves as the initial page

require_once 'assets/php/functions.php';
if (isset($_SESSION['Auth'])) {
    define('AUTHUSER', getUser($_SESSION['userdata']['id']));
} else {
    define('AUTHUSER', null);
}
$pageuri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pagesearchparams = $_GET;


//display pages from function
try {
    match ($pageuri) {
        '/test' => throw new Exception('ERROR!! Page not found!!'),
        '/' => showPage('home', 'Home', [], 'auth'),
        '/profile' => showPage('profile', 'Profile', ['user' => AUTHUSER], 'auth'),
        '/assess' => showPage('assess', 'Self-Assessment Form', ['user' => AUTHUSER], 'auth'),
        '/feedback' => showPage('feedback', 'Feedback Form', ['user' => AUTHUSER], 'auth'),
        '/notif' => showPage('notif', 'Notification', ['user' => AUTHUSER], 'auth'),
        '/signup' => showPage('signup', 'Sign Up'),
        '/login' => showPage('login', 'Login'),
        '/api/post/login' => showAPI('actions', 'POST'),
        '/api/post/signup' => showAPI('actions', 'POST'),
        '/api/post/logout' => showAPI('actions', 'POST'),
        '/api/post/updateprofile' => showAPI('actions', 'POST'),
        default => showPublicFolder('assets'),
    };
} catch (Throwable $e) {
    showPage('error', 'Internal Server Error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}

unset($_SESSION['error']);
unset($_SESSION['formdata']);
