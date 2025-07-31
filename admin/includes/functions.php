<?php
// /admin/includes/functions.php
// @rictus: notice the reset...
// Version: Reset

// Confirm config path
if (!defined('CONFIG_PATH')) {
    define('CONFIG_PATH', realpath(__DIR__ . '/../../app/core/config'));
}

// Get config array
function get_config($key = null, $fallback = null) {
    static $config = null;

    if ($config === null) {
        $file = CONFIG_PATH . '/config.php';
        if (file_exists($file)) {
            $config = include $file;
        } else {
            $config = ['settings' => []];
        }
    }

    if ($key === null) {
        return $config;
    }

    return $config['settings'][$key] ?? $fallback;
}

// Get active theme name
function get_active_theme() {
    return get_config('theme_name', 'default');
}

// List themes from /public/themes
function list_available_themes() {
    $themes = [];
    $path = PUBLIC_ROOT . '/themes';
    if (is_dir($path)) {
        foreach (scandir($path) as $item) {
            if ($item !== '.' && $item !== '..' && is_dir("$path/$item")) {
                $themes[] = $item;
            }
        }
    }
    return $themes;
}