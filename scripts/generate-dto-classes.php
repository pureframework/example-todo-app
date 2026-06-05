<?php

declare(strict_types=1);

/**
 * Regenerate DTO row classes from sql/*.sql (option A: single cache file).
 *
 * Usage:
 *   php scripts/generate-dto-classes.php
 *   composer generate-dto
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use PureFramework\DbGenerateClasses;

const DTO_SQL_PATH   = __DIR__ . '/../sql';
const DTO_CACHE_FILE = __DIR__ . '/../includes/dbGeneratedClasses.php';
const DTO_TYPED      = true;

$generated = DbGenerateClasses::generateFromPath(
    DTO_SQL_PATH,
    DTO_CACHE_FILE,
    true,
    DTO_TYPED,
);

if ($generated === []) {
    echo "No classes generated.\n";
    exit(0);
}

echo 'Wrote ' . DTO_CACHE_FILE . "\n";
foreach ($generated as $table) {
    echo "  - {$table}\n";
}
