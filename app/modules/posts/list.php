<?php
use app\core\db;
use app\core\post;

$db = new db();
$postHandler = new post($db);

$posts = $postHandler->get_all();

if ($posts):
    echo '<div class="container mt-4">';
    foreach ($posts as $post):
        $safeSlug = htmlspecialchars($post['post_slug']);
        echo "<div class='mb-4'>";
        echo "<h3>" . htmlspecialchars($post['title']) . "</h3>";
        echo "<p><em>Posted on " . date('F j, Y', strtotime($post['created_at'])) . "</em></p>";
        echo "<p>" . htmlspecialchars($post['intro']) . "</p>";
        echo "<a href='/posts/view/$safeSlug' class='btn btn-outline-primary btn-sm'>Read More</a>";
        echo "</div>";
    endforeach;
    echo '</div>';
else:
    echo '<p>No posts found.</p>';
endif;