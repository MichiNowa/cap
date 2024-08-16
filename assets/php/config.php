<?php
session_start();
const APP_TITLE = $_ENV['APP_TITLE'] ?? "SMCC";
const URI_PREFIX = $_ENV['URI_PREFIX'] ?? "/" . basename(__DIR__);

// connect to dataabse 
const DB_NAME = $_ENV['DB_NAME'] ?? 'gcms';
const DB_HOST = $_ENV['DB_HOST'] ?? 'localhost';
const DB_USER = $_ENV['DB_USER'] ?? 'root';
const DB_PASS = $_ENV['DB_PASS'] ?? '';
