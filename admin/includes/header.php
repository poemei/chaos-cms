<?php
if (!defined('ADMIN_LOADED')) exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | <?= ucfirst($section ?? 'Dashboard') ?></title>
  <link rel="stylesheet" href="<?= ASSET_URL ?>/admin.css">
</head>
<body>
  <header class="admin-header">
    <div class="container">
      <h1>Admin Panel</h1>
      <nav class="admin-nav">
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/posts">Posts</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/settings">Settings</a>
        <a href="/admin/plugins">Plugins</a>
        <a href="/admin/themes">Themes</a>
        <a href="/">Return to Site</a>
        <a href="/logout" class="logout-link">Logout</a>
      </nav>
    </div>
  </header>
  <main class="admin-main">