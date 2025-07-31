<?php
namespace app\core;

use app\core\db;

class post {

    private $db;

    public function __construct() {
        $this->db = new db();
    }

   public function get_all() {
    $conn = $this->db->connect();
    $sql = "SELECT p.*, u.name AS author_name 
            FROM posts p
            JOIN users u ON p.user_id = u.id
            WHERE p.is_published = 1
            ORDER BY p.created_at DESC";

    $result = $conn->query($sql);

    $posts = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
    }

    return $posts;
}

    public function get_latest() {
    $conn = $this->db->connect();

    $sql = "SELECT posts.*, users.name 
            FROM posts 
            LEFT JOIN users ON posts.user_id = users.id
            WHERE posts.is_published = 1
            ORDER BY posts.created_at DESC
            LIMIT 1";

    $result = $conn->query($sql);

    return ($result && mysqli_num_rows($result) > 0)
        ? mysqli_fetch_assoc($result)
        : null;
    }

    public function get_by_slug($slug) {
    $conn = $this->db->connect();
    $safe_slug = mysqli_real_escape_string($conn, $slug);

    $sql = "SELECT p.*, u.name AS author_name 
            FROM posts p
            JOIN users u ON p.user_id = u.id
            WHERE p.post_slug = '$safe_slug' AND p.is_published = 1
            LIMIT 1";

    $result = $conn->query($sql);

    return $result && mysqli_num_rows($result) > 0 ? mysqli_fetch_assoc($result) : null;
}

    public function get_topics_for_post($post_id) {
        $post_id = (int) $post_id;
        $sql = "SELECT t.name 
                FROM post_topic pt
                JOIN topics t ON pt.topic_id = t.id
                WHERE pt.post_id = $post_id";
        $result = $this->db->query($sql);
        $topics = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $topics[] = $row['name'];
        }
        return $topics;
    }

    public function get_by_topic($topic_id) {
        $topic_id = (int) $topic_id;
        $sql = "SELECT p.*, u.name AS author_name 
                FROM posts p
                JOIN post_topic pt ON p.id = pt.post_id
                JOIN topics t ON pt.topic_id = t.id
                JOIN users u ON a.user_id = u.id
                WHERE pt.topic_id = $topic_id AND p.is_published = 1
                ORDER BY p.created_at DESC";
        $result = $this->db->query($sql);
        $posts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
        return $posts;
    }
}