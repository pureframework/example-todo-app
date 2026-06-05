-- Reference only (not run by scripts/setup-db.php).
-- Create this database manually before running setup-db.php.
-- Name must match dbname= in config.php (PURE_DB_CONNECTION).

CREATE DATABASE IF NOT EXISTS `example_todo_app`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
