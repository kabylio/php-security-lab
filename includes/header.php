<?php
require_once __DIR__ . '/functions.php';
$flash = consume_flash();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Security Lab</title>
    <link rel="stylesheet" href="/php-security-lab/assets/css/style.css">
</head>
<body>
<nav class="topbar">
    <a class="brand" href="/php-security-lab/dashboard/index.php">Security Lab</a>
    <div class="nav-links">
        <?php if (is_logged_in()): ?>
            <a href="/php-security-lab/dashboard/index.php">Dashboard</a>
            <a href="/php-security-lab/profile/index.php">Profile</a>
            <a href="/php-security-lab/auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="/php-security-lab/auth/login.php">Login</a>
            <a href="/php-security-lab/auth/register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>
<main class="container">
<?php if ($flash): ?>
    <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
<?php endif; ?>
