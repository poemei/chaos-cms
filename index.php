<?php
// Index for poemei.com
//@rictus: always watch from here

require __DIR__ . '/app/bootstrap.php';


// Error Logging
ini_set('display_errors', 0); // Hide from user
ini_set('log_errors', 1);     // Enable logging
ini_set('error_log', __DIR__ . '/logs/php_errors.log');

// Optional: set error reporting level
error_reporting(E_ALL);
