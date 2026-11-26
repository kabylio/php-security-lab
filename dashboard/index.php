<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/database.php';
require_login();

$statement = $pdo->prepare('SELECT id, username, email, created_at, updated_at FROM users WHERE id = :id');
$statement->execute(['id' => $_SESSION['user_id']]);
$user = $statement->fetch();
?>
<section class="card">
    <p class="eyebrow">Account overview</p>
    <h1>Welcome, <?= e($user['username']) ?></h1>
    <dl class="details">
        <dt>Authentication status</dt><dd><span class="status">Authenticated</span></dd>
        <dt>Username</dt><dd><?= e($user['username']) ?></dd>
        <dt>Email</dt><dd><?= e($user['email']) ?></dd>
        <dt>Session ID</dt><dd class="mono"><?= e(session_id()) ?></dd>
        <dt>Member since</dt><dd><?= e($user['created_at']) ?></dd>
    </dl>
    <a class="button" href="/php-security-lab/profile/index.php">Account settings</a>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
