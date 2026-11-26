# CSRF Demonstration

`profile/index.php` accepts a POST and changes the authenticated user's email without a CSRF token or origin validation.

## Reproduction

1. Log in to `http://127.0.0.1/php-security-lab/auth/login.php` as `alice_lab`.
2. Open `http://127.0.0.1/php-security-lab/attacks/csrf/demonstration.php`, or use the separate-origin simulator described in the project README.
3. Submit the forged request.
4. Open the profile page and verify that the email changed to `csrf-attacked@example.test`.

## Expected result

The email changes because the browser sends the victim's PHP session cookie with the POST to `http://127.0.0.1/php-security-lab/profile/index.php`.
