<?php
namespace app\core;

class utility {
    
    private static $settings = [];

    public static function get_setting($key, $default = null) {
        // Return early if we've already loaded the settings
        if (!empty(self::$settings)) {
            return self::$settings[$key] ?? $default;
        }

        $config_file = __DIR__ . '/../../config/config.php';

        if (!file_exists($config_file)) {
            return $default;
        }

        $config = require $config_file;

        if (!empty($config['use_database'])) {
            require_once __DIR__ . '/db.php'; // Load the db class

            $db = new db(); // Assuming db class has a connect() method
            $conn = $db->connect();

            if ($conn) {
                $result = $conn->query("SELECT name, value FROM settings");

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        self::$settings[$row['name']] = $row['value'];
                    }
                }
            } else {
                return $default;
            }
        } else {
            self::$settings = $config['settings'] ?? [];
        }

        return self::$settings[$key] ?? $default;
    }


    public static function redirect_to($url) {
	    header('Location: '. $url);
	    exit;
     }

    public function load_file($path) {
            if (file_exists($path)) {
                include $path;
            } else {
                pretty_error("Missing file: <code>$path</code>");
                exit;
            }
        }
        
    public function pretty_error($message) {
            echo "<div style='
                background: #1e1e1e;
                color: #f88;
                padding: 1.5em;
                border: 2px solid #f00;
                font-family: monospace;
                margin: 2em;
                border-radius: 10px;
            '><strong>Error:</strong><br>$message</div>";
        
            $log_file = APP_ROOT . '/logs/site_error.log'; // 💡 This was missing!
        
            $log_line = "[" . date('Y-m-d H:i:s') . "] $message\n";
        
            if (file_exists($log_file) && filesize($log_file) > 1024 * 1024) { // 1MB
                rename($log_file, $log_file . '.' . time());
            }
        
            file_put_contents($log_file, $log_line, FILE_APPEND); // 💡 Was missing semicolon
        }
        
    public function throw_error($code = 500, $message = 'Unknown Error') {
            http_response_code($code);
        
            $friendly = [
                400 => 'Bad Request',
                403 => 'Forbidden',
                404 => 'Not Found',
                500 => 'Internal Server Error',
                503 => 'Service Unavailable'
            ];
        
            $title = $friendly[$code] ?? 'Error';
            pretty_error("[$code] $title: $message");
        
            // Optional: Log it
            $log_line = "[" . date('Y-m-d H:i:s') . "] [$code] $title — $message\n";
            @file_put_contents(APP_ROOT . '/logs/site_error.log', $log_line, FILE_APPEND);
        
            exit;
        }
}