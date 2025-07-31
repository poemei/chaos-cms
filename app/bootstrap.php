<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

//@rictus: bootstrap, the heartbeat of any site.
// Autoloader
spl_autoload_register(function ($class) {
    $class = ltrim($class, '\\');
    if (strpos($class, 'app\\') === 0) {
        $class_path = str_replace('\\', '/', $class);
        $file = __DIR__ . '/' . substr($class_path, 4) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            error_log("Autoload failed: $file\n", 3, __DIR__ . '/../logs/autoload_error.log');
        }
    }
});

session_start();
$db = new \app\core\db();
$auth = new \app\core\auth($db);
$post = new \app\core\post($db);
$util = new \app\core\utility();

$theme = $util->get_setting('theme_name', 'default');

// Server side routes
//define('APP_ROOT', realpath(__DIR__ . '/../'));
define('APP_ROOT', realpath(__DIR__ . '/../app'));
define('LOG_PATH', __DIR__ . '/../../logs');

// Front end URL's
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$base_path = '/'; // Adjust if your site lives in a subfolder

define('BASE_URL', $protocol . $host . $base_path);

// Load the Router
require __DIR__ . '/router.php';