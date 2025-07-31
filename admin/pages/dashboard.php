<?php
//require_once __DIR__ . '/../includes/header.php';

$core_sections = [
    'posts'     => 'Manage blog posts and content',
    'users'     => 'Manage CMS user accounts',
    'settings'  => 'Site configuration and global options',
    'plugins'   => 'Enable or disable plugins',
    'themes'    => 'Manage site appearance',
    'sentinel'  => 'Security monitor and denylist',
    'devthink'  => 'The DevBot Think Tank',
];

echo '<div class="container text-center"><h2>Admin Dashboard</h2>';

foreach ($core_sections as $section => $desc) {
    $icon_path = "/admin/includes/assets/icons/{$section}.png";
    echo '<div class="admin-tile">';
    echo "<a href='/admin/{$section}'>";
    echo "<img src='{$icon_path}' class='tile-icon' alt='{$section} icon height:24px; width:24px;'>";
    echo "<div class='tile-label'><strong>" . ucfirst($section) . "</strong><br><small>{$desc}</small></div>";
    echo '</a>';
    echo '</div>';
}

echo '</div>';

//require_once __DIR__ . '/../includes/footer.php';
?>