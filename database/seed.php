<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

$accounts = [
    ['alice_lab', 'alice@example.test', 'LabPassword123!'],
    ['bob_lab', 'bob@example.test', 'LabPassword123!'],
];

$pdo->beginTransaction();
$statement = $pdo->prepare(
    'INSERT INTO users (username, email, password)
     VALUES (:username, :email, :password)
     ON DUPLICATE KEY UPDATE email = VALUES(email), password = VALUES(password)'
);

foreach ($accounts as [$username, $email, $plainPassword]) {
    $statement->execute([
        'username' => $username,
        'email' => $email,
        'password' => password_hash($plainPassword, PASSWORD_DEFAULT),
    ]);
}

$pdo->commit();
echo "Seeded alice_lab and bob_lab.\n";
