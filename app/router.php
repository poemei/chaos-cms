<?php
/*
 * /app/router.php — Dynamic Router for poemei.com
 * Version 15, Chaos-forged in fire and fury
 */

// Load header
require_once __DIR__ . '/../public/themes/chaos/includes/header.php';

// Plugin and dev utilities
require_once __DIR__ . '/plugins/sentinel/sentinel_plugin.php';
sentinel_httpbl_check();

require_once __DIR__ . '/../devbot/plugins/devclock.php';
devclock::tick();

// Parse URI
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $uri);
$module = !empty($segments[0]) ? $segments[0] : 'home';

// List of core modules
$core_modules = ['posts', 'account', 'errors'];

// Route to correct module
if (in_array($module, $core_modules)) {
    $mod_path = __DIR__ . '/modules/' . $module . '/main.php';
} else {
    $mod_path = __DIR__ . '/../public/modules/' . $module . '/main.php';
}

// Load module or error fallback
if (file_exists($mod_path)) {
    require $mod_path;
} else {
    require __DIR__ . '/modules/errors/main.php';
}

// Load footer
require_once __DIR__ . '/../public/themes/chaos/includes/footer.php';
?>