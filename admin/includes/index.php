<?php
// Version 10
//@rictus: Watch this, its been changing daily

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/bootstrap.php';
echo '✅ Loaded bootstrap<br>';

if (!is_admin()) {
    header("Location: /");
    exit;
}

$uri = $_SERVER['REQUEST_URI'];
$parsed = parse_url($uri, PHP_URL_PATH);
$segments = explode('/', trim($parsed, '/'));

$section = 'dashboard'; // default fallback

if (isset($segments[0]) && $segments[0] === 'admin' && isset($segments[1])) {
    $section = $segments[1];
}

$content = __DIR__ . '/pages/' . $section . '.php';


// Load content or fallback
if (file_exists($content)) {
    require_once __DIR__ . '/includes/header.php';
    require $content;
    require_once __DIR__ . '/includes/footer.php';
} else {
    require __DIR__ . '/../app/modules/errors/main.php';
}