<?php

// ini_set('display_errors', 0);

define('WORKSPACE_DIR', __DIR__);

// this page serves as the initial page
require WORKSPACE_DIR . '/vendor/autoload.php';

use Dotenv\Dotenv;
try {
// use dotenv

// Initialize and load the .env file
$dotenv = Dotenv::createImmutable(__DIR__, [".env", ".env.local"]);
$dotenv->load();
} catch (Throwable $e) {
  print_r($e);
  exit;
}

require_once WORKSPACE_DIR . '/assets/php/functions.php';

try {

  if (isset($_SESSION['Auth'])) {
    define('AUTHUSER', getUser($_SESSION['userdata']['id']));
  } else {
    define('AUTHUSER', null);
  }
  // define sidebar links based on user role
  define('SIDEBAR_LINKS', getSidebarLinks(!is_null(AUTHUSER) ? AUTHUSER['role'] : 'student'));

  //display pages from function
  match (PAGE_URI) {
    '/test' => throw new Exception('ERROR!! Page not found!!'),
    '/' => redirect('/login'),
    '/home' => showPage('home', 'Home', [], 'auth', ['auth']),
    '/profile' => showPage('profile', 'Profile', ['user' => AUTHUSER], 'auth', ['auth']),
    '/assess' => showPage('assess', 'Self-Assessment Form', ['user' => AUTHUSER], 'auth', ['auth']),
    '/feedback' => showPage('feedback', 'Feedback Form', ['user' => AUTHUSER], 'auth', ['auth']),
    '/notif' => showPage('notif', 'Notification', ['user' => AUTHUSER], 'auth', ['auth']),
    '/signup' => showPage('signup', 'Sign Up', ["scripts" => [pathname("js/react/signup.mjs")]], 'guest', ['guest']),
    '/login' => showPage('login', 'Login', [], 'guest', ['guest']),
    '/api/post/login' => showAPI('actions', 'POST'),
    '/api/post/signup' => showAPI('actions', 'POST'),
    '/api/post/logout' => showAPI('actions', 'POST'),
    '/api/post/updateprofile' => showAPI('actions', 'POST'),
    '/api/get/student/check' => showAPI('get'),
    default => showPublicFolder('assets'),
  };
} catch (Throwable $e) {
  showPage('error', 'Internal Server Error', ['error' => $e->getMessage() ." in ". $e->getFile() ." line ". $e->getLine(), 'trace' => $e->getTraceAsString()]);
}

unset($_SESSION['error']);
unset($_SESSION['formdata']);
