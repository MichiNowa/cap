<?php

// this page serves as the initial page
require 'vendor/autoload.php';
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
        '/' => redirect('/login'),
        '/home' => showPage('home', 'Home', [], 'auth', 'auth'),
        '/profile' => showPage('profile', 'Profile', ['user' => AUTHUSER], 'auth', 'auth'),
        '/assess' => showPage('assess', 'Self-Assessment Form', ['user' => AUTHUSER], 'auth', 'auth'),
        '/feedback' => showPage('feedback', 'Feedback Form', ['user' => AUTHUSER], 'auth', 'auth'),
        '/notif' => showPage('notif', 'Notification', ['user' => AUTHUSER], 'auth', 'auth'),
        '/signup' => showPage('signup', 'Sign Up', 'guest', 'guest'      ),
        '/login' => showPage('login', 'Login', 'guest', 'guest'),
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
