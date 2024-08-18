<?php
session_start();

define('PAGE_URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
define('PAGE_SEARCH_PARAMS', $_GET);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // check if uri is does not have file extension
  $uri = explode('/', PAGE_URI);
  $uri = array_pop($uri);
  // check if $uri string does not contain a file extension
  $ext = pathinfo($uri, PATHINFO_EXTENSION);
  if (empty($ext)) {
    $_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
  }
}
define('APP_TITLE', $_ENV['APP_TITLE'] ?? "SMCC");
define('URI_PREFIX', $_ENV['URI_PREFIX'] ?? "/" . basename(dirname(dirname(__DIR__))));

// connect to dataabse
define('DB_NAME', $_ENV['DB_NAME'] ?? 'gcms');
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');

