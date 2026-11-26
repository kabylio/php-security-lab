# Architecture

- `config/database.php` creates a PDO connection.
- `includes/` contains shared session, navigation, and rendering helpers.
- `auth/` implements registration, login, and logout.
- `dashboard/` displays authenticated account details.
- `profile/` implements the account update endpoint.
- `attacks/` contains controlled demonstrations and instructions.
- `database/` contains the schema and test-data seeder.
