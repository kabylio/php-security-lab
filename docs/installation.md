# Installation

1. Start Apache and MariaDB/MySQL.
2. Confirm PHP 8.x has the `pdo_mysql` extension.
3. Copy the project to the Apache document root.
4. Import `database/schema.sql`.
5. Run `database/seed.php`.
6. Open `http://127.0.0.1/php-security-lab/`.

The supplied configuration uses the local WAMP MariaDB instance on port 3307.
