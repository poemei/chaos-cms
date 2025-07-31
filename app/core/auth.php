<?php
namespace app\core;

use app\core\db;

class auth {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($email, $password) {
        $conn = $this->db->connect();
        if (!$conn) {
            error_log("AUTH: DB connection failed\n", 3, LOG_PATH);
            return false;
        }

        $stmt = $conn->prepare("SELECT id, username, name, role, password FROM users WHERE email = ?");
        if (!$stmt) {
            error_log("AUTH: Failed to prepare login query\n", 3, LOG_PATH);
            return false;
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                return true;
            } else {
                error_log("AUTH: Invalid password attempt for {$email}\n", 3, LOG_PATH);
            }
        } else {
            error_log("AUTH: No user found for {$email}\n", 3, LOG_PATH);
        }

        return false;
    }

    public function logout() {
    // Clear all session data
    $_SESSION = [];

    // Destroy the session
    if (session_id() !== '' || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }

    session_unset();
    session_destroy();
}
}