<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // V1 intentional weakness: this state-changing POST accepts authenticated sessions
    // without a CSRF token or origin validation.
    // Blue Team remediation: generate and validate an unpredictable per-session token.
    $email = trim((string) ($_POST['email'] ?? ''));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
        flash('error', 'Enter a valid email address.');
        redirect('/php-security-lab/profile/index.php');
    }

    try {
        $update = $pdo->prepare('UPDATE users SET email = :email WHERE id = :id');
        $update->execute(['email' => $email, 'id' => $_SESSION['user_id']]);
        flash('success', 'Email updated successfully.');
        redirect('/php-security-lab/dashboard/index.php');
    } catch (PDOException $exception) {
        flash('error', 'Email is already in use.');
        redirect('/php-security-lab/profile/index.php');
    }
}

require_once __DIR__ . '/../includes/header.php';

$statement = $pdo->prepare('SELECT id, username, email FROM users WHERE id = :id');
$statement->execute(['id' => $_SESSION['user_id']]);
$user = $statement->fetch();
?>
<section class="card narrow">
    <p class="eyebrow">Account settings</p>
    <h1>Profile</h1>
    <form method="post" action="/php-security-lab/profile/index.php">
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
