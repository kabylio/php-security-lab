<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../config/database.php';
require_login();

// V1 intentional weakness: this state-changing POST accepts authenticated sessions
// without a CSRF token or origin validation.
// Blue Team remediation: generate and validate an unpredictable per-session token.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

$email = trim((string) ($_POST['email'] ?? ''));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 255) {
    flash('error', 'Enter a valid email address.');
    redirect('/php-security-lab/profile/index.php');
}

try {
    $statement = $pdo->prepare('UPDATE users SET email = :email WHERE id = :id');
    $statement->execute(['email' => $email, 'id' => $_SESSION['user_id']]);
    flash('success', 'Email updated successfully.');
} catch (PDOException $exception) {
    flash('error', 'Email is already in use.');
}

redirect('/php-security-lab/profile/index.php');
