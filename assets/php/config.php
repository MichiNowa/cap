<?php
session_start();
define('APP_TITLE', $_ENV['APP_TITLE'] ?? "SMCC");
define('URI_PREFIX', $_ENV['URI_PREFIX'] ?? "/" . basename(dirname("assets/")));

// connect to dataabse 
define('DB_NAME', $_ENV['DB_NAME'] ?? 'gcms');
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
