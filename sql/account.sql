-- Account table: username + password authentication

DROP TABLE IF EXISTS `account`;

CREATE TABLE IF NOT EXISTS `account` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `account_uuid` BINARY(16) NOT NULL,
    `username` VARCHAR(32) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_account_uuid` (`account_uuid`),
    UNIQUE KEY `uk_account_username` (`username`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
