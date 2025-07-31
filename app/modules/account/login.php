<?php
// app/modules/account/login.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../bootstrap.php';

// Handle logout if requested
$path = $_SERVER['REQUEST_URI'];
if (strpos($path, '/account/logout') === 0) {
    $auth->logout();
    $util->redirect_to('/');
    exit;
}

// Handle login POST
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($auth->login($email, $password)) {
        $util->redirect_to('/admin'); // or wherever you want to land
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="container mb-5">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" class="mt-3">
        <div class="mb-3">
            <label>Email address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">Log In</button>
    </form>
</div>