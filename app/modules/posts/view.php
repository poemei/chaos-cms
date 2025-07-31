<?php
use app\core\db;
use app\core\post;

$slug = $_GET['slug'] ?? null;

if (!$slug) {
    echo '<p>Post slug missing.</p>';
    return;
}

$db = new db();
$postHandler = new post($db);
$post = $postHandler->get_by_slug($slug);

if (!$post) {
    echo '<p>Post not found.</p>';
    return;
}

echo "<div class='container mt-5'>";
echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
echo "<p><em>By " . htmlspecialchars($post['author_name']) . " on " . date('F j, Y', strtotime($post['created_at'])) . "</em></p>";
echo "<div class='mb-3'>" . $post['intro'] . "</div>";
echo "<div class='mb-3'>" . $post['content'] . "</div>";
if (!empty($post['updated_at'])) {
    echo "<p><small class='text-muted'>Last updated: " . date('F j, Y, g:i A', strtotime($post['updated_at'])) . "</small></p>";
}
echo "</div>";