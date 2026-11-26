# Session Fixation Demonstration

This baseline intentionally does not call `session_regenerate_id()` after login.

## Reproduction

1. Open a private browser session and request `http://127.0.0.1/php-security-lab/dashboard/index.php`.
2. Record the `PHPSESSID` cookie and session ID shown after login.
3. Set the same session ID in a second isolated browser session using browser developer tools.
4. In Browser A, log in as `alice_lab`.
5. Confirm Browser B inherits the authenticated session and can access the dashboard.

The dashboard displays `session_id()` to make the before/after comparison visible.

## Expected result

The session identifier remains unchanged when unauthenticated state is replaced by authenticated state.
