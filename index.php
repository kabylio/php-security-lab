<?php
require_once __DIR__ . '/includes/functions.php';
redirect('/php-security-lab/' . (is_logged_in() ? 'dashboard/index.php' : 'auth/login.php'));
