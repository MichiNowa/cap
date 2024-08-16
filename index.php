<?php

// this page serves as the initial page

require_once 'assets/php/functions.php';
if (isset($_SESSION['Auth'])) {
    $user = getUser($_SESSION['userdata']['id']);
}
$pageuri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pagesearchparams = $_GET;


//display pages from funtcion
match ($pageuri) {
    '/' => showPage('home', 'Home', [], 'auth'),
    '/profile' => showPage('profile', 'Profile', ['user' => $user], 'auth'),
    '/assess' => showPage('assess', 'Self-Assessment Form', ['user' => $user], 'auth'),
    '/feedback' => showPage('feedback', 'Feedback Form', ['user' => $user], 'auth'),
    '/notif' => showPage('notif', 'Notification', ['user' => $user], 'auth'),
    '/signup' => showPage('signup', 'Sign Up'),
    '/login' => showPage('login', 'Login'),
    '/api/post/login' => showAPI('actions', 'POST'),
    '/api/post/signup' => showAPI('actions', 'POST'),
    '/api/post/logout' => showAPI('actions', 'POST'),
    '/api/post/updateprofile' => showAPI('actions', 'POST'),
    default => showPublicFolder('assets/static'),
};

unset($_SESSION['error']);
unset($_SESSION['formdata']);
