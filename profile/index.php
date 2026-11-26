<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/database.php';
require_login();

$statement = $pdo->prepare('SELECT id, username, email FROM users WHERE id = :id');
$statement->execute(['id' => $_SESSION['user_id']]);
$user = $statement->fetch();
?>
<section class="card narrow">
    <p class="eyebrow">Account settings</p>
    <h1>Profile</h1>
    <form method="post" action="/php-security-lab/profile/update.php">
        <label>Username
            <input value="<?= e($user['username']) ?>" disabled>
        </label>
        <label>Email
            <input type="email" name="email" required maxlength="255" value="<?= e($user['email']) ?>">
        </label>
        <button type="submit">Update email</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
