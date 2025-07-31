<?php
// /admin/pages/themes.php
// @rictus: track this hawt mess, versin 4 so far and its only 11am

// Error Logging
ini_set('display_errors', 1); // Hide from user
ini_set('log_errors', 1);     // Enable logging
ini_set('error_log', __DIR__ . '/logs/themes_errors.log');

// Optional: set error reporting level
error_reporting(E_ALL);


$active = get_active_theme();
$themes = list_available_themes();
?>

<h2>Themes</h2>
<div class="theme-list">
    <?php foreach ($themes as $theme): ?>
        <div class="theme-item">
            <strong><?= htmlspecialchars($theme) ?></strong>
            <?php if ($theme === $active): ?>
                <span style="color: green;">(Active)</span>
            <?php else: ?>
                <button class="btn btn-sm btn-outline-primary" onclick="alert('Switch to <?= $theme ?> (TODO)')">Activate</button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>