<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../config/database.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
        $errors[] = 'Username must be 3-50 characters and use letters, numbers, or underscores.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
        $errors[] = 'Enter a valid email address.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if (!$errors) {
        try {
            $statement = $pdo->prepare(
                'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
            );
            $statement->execute([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            flash('success', 'Account created. You can now log in.');
            redirect('/php-security-lab/auth/login.php');
        } catch (PDOException $exception) {
            $errors[] = 'Username or email is already in use.';
        }
    }
}
?>
<section class="card narrow">
    <h1>Create account</h1>
    <?php foreach ($errors as $error): ?>
        <div class="alert error"><?= e($error) ?></div>
    <?php endforeach; ?>
    <form method="post" action="/php-security-lab/auth/register.php">
        <label>Username
            <input name="username" required maxlength="50" value="<?= e((string) ($_POST['username'] ?? '')) ?>">
        </label>
        <label>Email
            <input type="email" name="email" required maxlength="255" value="<?= e((string) ($_POST['email'] ?? '')) ?>">
        </label>
        <label>Password
            <input type="password" name="password" required minlength="8">
        </label>
        <button type="submit">Register</button>
    </form>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
