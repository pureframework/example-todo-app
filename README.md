# Example Todo App

A small [Pure Framework](https://github.com/pureframework/pure-framework) example: register, log in with username and password, and manage a personal todo list.

## Requirements

- PHP 8.1+
- Composer 2.x
- MySQL 5.7+ or MariaDB 10.3+
- Web server with document root pointing at `htdocs/` (Apache `mod_rewrite` or nginx equivalent)

## Install

```bash
cd example-todo-app
composer install
```

Copy local database credentials (optional):

```bash
cp _env.php.example _env.php
# Edit _env.php with your MySQL user and password
```

Create the MySQL database (name must match `dbname=` in `_env.php`, default `example_todo_app`). Example:

```sql
CREATE DATABASE example_todo_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

See `scripts/sql/00_database.sql` for a copy-paste template.

Then create tables and optional demo user:

```bash
php scripts/setup-db.php
```

This runs `sql/account.sql` and `sql/todo.sql`, and seeds a demo account:

| Username | Password    |
| -------- | ----------- |
| `demo`   | `demo12345` |

Regenerate row classes after changing SQL:

```bash
composer generate-dto
# or: php scripts/generate-dto-classes.php
```

The script is `scripts/generate-dto-classes.php` (option A cache file). See [Pure Framework — application script](https://github.com/pureframework/pure-framework/blob/main/docs/database.md#application-script-scriptsgenerate-dto-classesphp) for option B and typed output.

## Web server

Point the **document root** at `htdocs/`. Apache: use the included `htdocs/.htaccess`.

### Laravel Herd / Valet

Link the **project root** (`example-todo-app/`), not `htdocs/`. `LocalValetDriver.php` sends every request to `htdocs/index.php` and serves static files from `htdocs/`. Run `herd restart` after changing the driver.

Example PHP built-in server (development only):

```bash
php -S localhost:8080 -t htdocs
```

Visit `http://localhost:8080/`.

## Features

- **Register** — `/register` (username, password, confirm password)
- **Log in** — `/login`
- **Log out** — POST `/logout` (CSRF-protected)
- **Todos** — `/todos`: list, add, mark done/undo, delete (scoped to the logged-in account)

Sessions use Pure Framework `Session` bootstrap helpers; auth state lives in `includes/auth.php`. Passwords are stored with `password_hash()`.

## Project layout

| Path                               | Purpose                                                  |
| ---------------------------------- | -------------------------------------------------------- |
| `htdocs/`                          | Document root, routes in `index.php`                     |
| `includes/`                        | `DB`, auth, entities, constraints                        |
| `sql/`                             | Table definitions (`account`, `todo`)                    |
| `templates/`                       | Layout and partials                                      |
| `scripts/setup-db.php`             | Database bootstrap                                       |
| `scripts/generate-dto-classes.php` | Regenerate `includes/dbGeneratedClasses.php` from `sql/` |

## Dependency

The app depends on Packagist package `pureframework/pure-framework` (^1.4), not a path repository to a local checkout. Entity updates use `DB::objectUpdateFactory()` so typed DTO `$updateSkip` protects identity columns.
