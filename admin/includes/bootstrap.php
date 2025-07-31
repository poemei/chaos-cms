<?php
// /admin/bootstrap.php
//@rictus: watch this and scan for errors

// Error Logging
ini_set('display_errors', 1); // Hide from user
ini_set('log_errors', 1);     // Enable logging
ini_set('error_log', __DIR__ . '/../logs/admin_errors.log');

// Optional: set error reporting level
error_reporting(E_ALL);


echo 'Hello from bootstrap<br>';

// Paths
define('ADMIN_ROOT', __DIR__);
define('PUBLIC_ROOT', realpath(__DIR__ . '/../public'));
define('CONFIG_PATH', realpath(__DIR__ . '/../app/core/config'));
define('LOG_PATH', realpath(__DIR__ . '/../logs'));
define('ASSET_URL', '/admin/includes/assets');

echo 'Attempting to load functions<br>';
// Load shared functions
require_once ADMIN_ROOT . '/includes/functions.php';