<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    $statement = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :username');
    $statement->execute(['username' => $username]);
    $user = $statement->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // V1 intentional weakness: the pre-authentication native session ID is retained.
        // Blue Team remediation: regenerate the session ID after successful authentication.
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['username'] = $user['username'];
        flash('success', 'Login successful.');
        redirect('/php-security-lab/dashboard/index.php');
    }
    $error = 'Invalid username or password.';
}
?>
<section class="card narrow">
    <h1>Sign in</h1>
    <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
    <form method="post" action="/php-security-lab/auth/login.php">
        <label>Username
            <input name="username" required value="<?= e((string) ($_POST['username'] ?? '')) ?>">
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Login</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
