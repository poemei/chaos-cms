<?php
// app/core/db.php

namespace app\core;

class db {

    private function db_connect() {
        if (!file_exists(__DIR__ . '/config/config.php')) {
            \app\core\logger::error("DB Config file not found in db_connect()");
            \app\core\utility::pretty_error("500", "Configuration Error", "The database configuration file is missing.");
            return null;
        }

        $conf = include(__DIR__ . '/config/config.php');
        $settings = $conf['settings'] ?? [];

        $conn = mysqli_connect(
            $settings['db_host'] ?? 'localhost',
            $settings['db_user'] ?? '',
            $settings['db_pass'] ?? '',
            $settings['db_name'] ?? ''
        );

        if (!$conn) {
            \app\core\logger::error("DB Connect failed: " . mysqli_connect_error());
            \app\core\utility::pretty_error("503", "Database Error", "Unable to establish a database connection.");
            return null;
        }

        return $conn;
    }
    
    public function connect() {
        return $this->db_connect();
    }
    
    public function query($sql) {
        $conn = $this->db_connect();
        if (!$conn) {
            return null;
        }
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo mysqli_error($conn);
        }
        return $result;
    }
}