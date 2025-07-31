<?php
//@rictus: this module is broken, admin_users table got dropped, too much bloat
use app\core\post;

$post = new post();

// Parse request
$uri = $_SERVER['REQUEST_URI'];
$base = '/posts'; // adjust if needed for subfolder
$path = str_replace($base, '', parse_url($uri, PHP_URL_PATH));
$segments = array_values(array_filter(explode('/', $path)));

// Action and optional slug
$action = $segments[0] ?? 'list';
$slug = $segments[1] ?? null;

// Route logic
switch ($action) {
    case 'view':
        if (!empty($slug)) {
            $_GET['slug'] = $slug;
            include __DIR__ . '/view.php';
        } else {
            echo "Post slug missing.";
        }
        break;

    case 'list':
    default:
        include __DIR__ . '/list.php';
        break;
}