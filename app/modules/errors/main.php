<?php

/*
 * errors()
 * Because every site needs an error handler
 * Written for the ChaosCMS on the lead developers 
 * website @ poemei.com
 * Takes the header response and returns a more
 * pleasing interface wrapped u inside the website.
 *
*/

$uri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($uri, '/'));
$code = $segments[1] ?? '404';

switch ($code) {
    case '403':
        header("HTTP/1.1 403 Forbidden");
        $title = "403 Forbidden";
        $message = "Access denied.";
        break;
    case '500':
        header("HTTP/1.1 500 Internal Server Error");
        $title = "500 Internal Server Error";
        $message = "An unexpected server error occurred.";
        break;
    case '503':
        header("HTTP/1.1 503 Service Unavailable");
        $title = "503 Service Unavailable";
        $message = "Site is currently down for maintenance.";
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        $title = "404 Not Found";
        $message = "The page you requested does not exist.";
        break;
}
echo "<pre>LOG_PATH: " . (defined('LOG_PATH') ? LOG_PATH : 'NOT DEFINED') . "</pre>";
$log_msg = "[Error $code] $title at " . $_SERVER['REQUEST_URI'] . " on " . date('Y-m-d H:i:s') . "\n";
$log_file = LOG_PATH . '/site_errors.log';

if (is_writable(LOG_PATH)) {
    file_put_contents($log_file, $log_msg, FILE_APPEND);
} else {
    error_log("LOG_PATH not writable: $log_file");
}

?>

<div class="container mt-5 text-center">
    <h1><?= htmlspecialchars($title) ?></h1>
    <p class="lead"><?= htmlspecialchars($message) ?></p>
    <a href="/" class="btn btn-outline-primary mt-4">Back to Home</a>
</div>