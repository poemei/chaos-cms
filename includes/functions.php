<?php

/*
 * nav_active()
 * Written with Bootstrap in mind
 * USAGE: <a class="nav-link <?= nav_active('main') ?>" href="/">Home</a>
 * Use at the theme level
*/
function nav_active($target) {
    $request = $_SERVER['REQUEST_URI'];
    $path = parse_url($request, PHP_URL_PATH);
    $segments = explode('/', trim($path, '/'));

    // Handle root/home
    if ($target === 'home' && (empty($segments[0]) || $segments[0] === 'index.php')) {
        return 'active disabled';
    }

    return (isset($segments[0]) && $segments[0] === $target) ? 'active' : '';
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}