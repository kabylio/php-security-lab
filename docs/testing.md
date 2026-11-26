# Testing

## Session fixation

1. In Browser A, open the dashboard without logging in.
2. Record `PHPSESSID`.
3. Copy the cookie into Browser B.
4. Log in in Browser A.
5. Refresh Browser B.
6. Confirm both browsers share the same session ID and Browser B becomes authenticated.

## CSRF

1. Log in as `alice_lab`.
2. Open the local CSRF demonstration.
3. Submit the request.
4. Return to the profile page.
5. Confirm the email changed.

## Reset

Re-import the schema and rerun the seed script after each test.
