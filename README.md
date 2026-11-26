# PHP Web Security Lab - Version 1

An intentionally vulnerable local PHP application for an authorized Red Team vs. Blue Team exercise.

## Features

- Registration, login, logout, and dashboard
- Profile email updates
- Prepared PDO database access
- Password hashing with `password_hash()`
- Intentional session fixation weakness
- Intentional CSRF weakness

## Requirements

- Windows with WAMP or XAMPP
- PHP 8.x with PDO MySQL
- MariaDB or MySQL
- Apache

## Installation

1. Place the project in `C:\wamp64\www\php-security-lab`.
2. Start Apache and MariaDB/MySQL.
3. Import the schema:

   ```powershell
   C:\wamp64\bin\mariadb\mariadb11.5.2\bin\mysql.exe -P 3307 -u root < "C:\wamp64\www\php-security-lab\database\schema.sql"
   C:\wamp64\bin\php\php8.3.14\php.exe "C:\wamp64\www\php-security-lab\database\seed.php"
   ```

4. Open `http://127.0.0.1/php-security-lab/auth/login.php`.

Update `config/database.php` if the database port or credentials differ.

## Test accounts

- `alice_lab` / `LabPassword123!`
- `bob_lab` / `LabPassword123!`

These credentials are dummy lab credentials only.

## Reset

```powershell
C:\wamp64\bin\mariadb\mariadb11.5.2\bin\mysql.exe -P 3307 -u root < "C:\wamp64\www\php-security-lab\database\schema.sql"
C:\wamp64\bin\php\php8.3.14\php.exe "C:\wamp64\www\php-security-lab\database\seed.php"
```

## Vulnerability demonstrations

- Session fixation: `attacks/session_fixation/README.md`
- CSRF: `attacks/csrf/README.md`

## Screenshots and evidence

Record login state, dashboard session ID, profile page, database values, and browser network requests.
