<?php<?php defined('ADMIN_LOADED') or die('Unauthorized'); ?>

<?php require_once __DIR__ . '/../../devbot/plugins/devthink.php'; ?>

<h2>🧠 DevThink – Today’s Dev Notes</h2>

<?php
// Add new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_add'])) {
    $task = trim($_POST['task_add']);
    if ($task !== '') {
        devthink::add($task);
        echo "<p style='color:green;'>✔️ Task added: {$task}</p>";
    } else {
        echo "<p style='color:red;'>❌ Empty task ignored.</p>";
    }
}

// Toggle task done
if (isset($_GET['toggle'])) {
    $task = $_GET['toggle'];
    devthink::toggle_done($task);
    echo "<p style='color:blue;'>🔄 Task updated: {$task}</p>";
}

$tasks = devthink::today();
?>

<form method="post" style="margin-bottom:20px;">
    <input type="text" name="task_add" placeholder="New dev task..." required style="width: 70%;">
    <button type="submit">➕ Add Task</button>
</form>

<?php if (empty($tasks)): ?>
    <p><em>No dev tasks logged yet for today.</em></p>
<?php else: ?>
    <ul>
        <?php foreach ($tasks as $item): ?>
            <li>
                <?php
                    $prefix = $item['done'] ? '✅' : '🛠️';
                    $style = $item['done'] ? 'text-decoration: line-through; color: #666;' : '';
                    $task = htmlspecialchars($item['task']);
                    $link = "?page=devthink&toggle=" . urlencode($item['task']);
                ?>
                <a href="<?= $link ?>" style="<?= $style ?>"><?= $prefix ?> <?= $task ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>