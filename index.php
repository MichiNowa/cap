<?php
use Smcc\Gcms\orm\Database;
use Smcc\Gcms\orm\models\Admin;
use Smcc\Gcms\orm\models\Schoolyear;

// ini_set('display_errors', 0);

define('WORKSPACE_DIR', __DIR__);

// this page serves as the initial page
require WORKSPACE_DIR . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Smcc\Gcms\orm\models\Users;

try {
// Initialize and load the .env file
$dotenv = Dotenv::createImmutable(__DIR__, [".env", ".env.local"]);
$dotenv->load();
} catch (Throwable $e) {}

require_once WORKSPACE_DIR . '/assets/php/functions.php';

try {

  if (isset($_SESSION['Auth'])) {
    define('AUTHUSER', getUser($_SESSION['userdata']['id']));
  } else {
    define('AUTHUSER', null);
  }
  // define sidebar links based on user role
  define('SIDEBAR_LINKS', getSidebarLinks(!is_null(AUTHUSER) ? AUTHUSER->role : null));
  Database::createSeed();
  //display pages from function
  match (CLEARED_PAGE_URI) {
    '/test' => throw new Exception('ERROR!! Page not found!!'),
    '/' => redirect('/login'),
    // Superadmin routes
    '/schoolyear' => showPage('superadmin/schoolyear', 'Manage Scool Year', [
      'user' => AUTHUSER,
      'data' => Schoolyear::all(),
      'scripts' => [
        pathname('js/schoolyear.js')
      ]
    ], 'auth', ['auth']),
    '/accounts/admin' => showPage('superadmin/admin', 'Manage Admin Accounts', [
      'user' => AUTHUSER,
      'data' => [
        "admins" => array_map(fn($mapped) => [...$mapped->toArray(), "password" => ''], array: Users::findMany("role", "admin")),
      ],
      'scripts' => [
        pathname('js/react/alladmin.mjs')
      ]
    ], 'auth', ['auth']),
    '/accounts/student' => showPage('superadmin/student', 'Manage Student Accounts', [
      'user' => AUTHUSER,
      'data' => [
        "students" => array_map(fn($mapped) => [...$mapped->toArray(), "password" => ''], array: Users::findMany("role", "student")),
      ],
      'scripts' => [
        pathname('js/react/allstudent.mjs')
      ]
    ], 'auth', ['auth']),
    // Admin rotues
    '/print' => showPage('admin/print', 'Print', ['user' => AUTHUSER], 'print', ['auth']),
    // Student routes
    '/home' => showPage('student/home', 'Home', ['user' => AUTHUSER, 'scripts' => [pathname('js/print.js')]], 'auth', ['auth']),
    '/profile' => showPage('student/profile', 'Profile', ['user' => AUTHUSER, 'scripts' => [pathname("js/inputProfile.js")]], 'auth', ['auth']),
    '/assess' => showPage('student/assess', 'Self-Assessment Form', ['user' => AUTHUSER,], 'auth', ['auth']),
    '/feedback' => showPage('student/feedback', 'Feedback Form', ['user' => AUTHUSER], 'auth', ['auth']),
    // Authentication routes
    '/signup' => showPage('auth/signup', 'Sign Up', ["scripts" => [pathname("js/react/signup.mjs")]], 'guest', ['guest']),
    '/login' => showPage('auth/login', 'Login', ["scripts" => [pathname("js/inputForm.js")]], 'guest', ['guest']),
    // General routes
    '/notif' => showPage('notif', 'Notification', ['user' => AUTHUSER], 'auth', ['auth']),
    // API Routes
    // POST
    '/api/post/login' => showAPI('actions', 'POST'),
    '/api/post/signup' => showAPI('actions', 'POST'),
    '/api/post/logout' => showAPI('actions', 'POST'),
    '/api/post/updateprofile' => showAPI('actions', 'POST'),
    '/api/post/openschoolyear' => showAPI('superadmin', 'POST'),
    '/api/post/add/admin' => showAPI('superadmin', 'POST'),
    '/api/post/edit/admin' => showAPI('superadmin', 'POST'),
    "/api/set/admin/active" => showAPI('superadmin', 'POST'),
    "/api/set/admin/inactive" => showAPI('superadmin', 'POST'),
    '/api/post/edit/student' => showAPI('superadmin', 'POST'),
    "/api/set/student/active" => showAPI('superadmin', 'POST'),
    "/api/set/student/inactive" => showAPI('superadmin', 'POST'),
    // GET
    '/api/get/pagedata' => showAPI( 'get'),
    '/api/get/student/check' => showAPI('get'),
    default => showPublicFolder('assets'),
  };
} catch (Throwable $e) {
  showPage('error', 'Internal Server Error', ['error' => $e->getMessage() ." in ". $e->getFile() ." line ". $e->getLine(), 'trace' => $e->getTraceAsString()]);
}

unset($_SESSION['error']);
unset($_SESSION['formdata']);
