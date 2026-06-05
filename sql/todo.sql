-- Todo items owned by an account

DROP TABLE IF EXISTS `todo`;

CREATE TABLE IF NOT EXISTS `todo` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `todo_uuid` BINARY(16) NOT NULL,
    `account_uuid` BINARY(16) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `completed_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_todo_uuid` (`todo_uuid`),
    KEY `idx_todo_account_uuid` (`account_uuid`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
