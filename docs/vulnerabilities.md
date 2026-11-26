# Intentional Vulnerabilities

## Session fixation

`auth/login.php` intentionally retains the native pre-authentication PHP session ID after authentication. It intentionally omits `session_regenerate_id(true)`.

## CSRF

`profile/update.php` intentionally accepts a state-changing POST from an authenticated session without a CSRF token or origin/referer validation.

No additional unrelated application vulnerability is intentionally introduced.
