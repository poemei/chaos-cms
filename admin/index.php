<?php
// /admin/index.php
// @rictus: track this, had to reset after version 11
// Version: Reset

// Start session
session_start();

// Load admin bootstrap
require_once __DIR__ . '/bootstrap.php';

// Temporary skip check (fix access later)
// if (!is_admin()) {
//     header("Location: /");
//     exit;
// }

// Parse URI
$uri = $_SERVER['REQUEST_URI'];
$parsed = parse_url($uri, PHP_URL_PATH);
$segments = explode('/', trim($parsed, '/'));

// Resolve section
$section = 'dashboard';
if (isset($segments[0]) && $segments[0] === 'admin' && isset($segments[1])) {
    $section = $segments[1];
}

$content = __DIR__ . '/pages/' . $section . '.php';

// Log for debugging
file_put_contents(LOG_PATH . '/admin_debug.log',
    "Requested URI: $uri\nParsed Path: $parsed\nSection: $section\nContent File: $content\n\n",
    FILE_APPEND
);

// Load page
if (file_exists($content)) {
    require_once __DIR__ . '/includes/header.php';
    require $content;
    require_once __DIR__ . '/includes/footer.php';
} else {
    require __DIR__ . '/../app/modules/errors/main.php';
}