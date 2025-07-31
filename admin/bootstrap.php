<?php
// /admin/bootstrap.php
// @rictus for real, watch this, this fucking AI has things all fucked up.
// Version: Reset

// Error logging setup
ini_set('display_errors', 0); // Don't display to users
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/admin_errors.log');
error_reporting(E_ALL);

// Define paths
define('ADMIN_ROOT', __DIR__);
define('PUBLIC_ROOT', realpath(__DIR__ . '/../public'));
define('CONFIG_PATH', realpath(__DIR__ . '/../app/core/config'));
define('LOG_PATH', realpath(__DIR__ . '/../logs'));
define('ASSET_URL', '/admin/includes/assets');

// Load shared functions
require_once ADMIN_ROOT . '/includes/functions.php';