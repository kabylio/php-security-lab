# Intentional Vulnerabilities

## Session fixation

`auth/login.php` intentionally retains the native pre-authentication PHP session ID after authentication. It intentionally omits `session_regenerate_id(true)`.

## CSRF

`profile/index.php` intentionally accepts a state-changing POST from an authenticated session without a CSRF token or origin/referer validation. `profile/update.php` remains a compatibility path to the same handler.

No additional unrelated application vulnerability is intentionally introduced.
