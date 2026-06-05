<?php

define('APP_ENV', 'development');

if (is_file(__DIR__ . '/_env.php')) {
	require __DIR__ . '/_env.php';
}

define('PURE_LAYOUT_PATH', __DIR__ . '/templates');
define('PURE_HTDOCS_PATH', __DIR__ . '/htdocs');

define('PURE_DB_SQL_PATH', __DIR__ . '/sql');
define('PURE_DB_SQL_CACHE', __DIR__ . '/includes/dbGeneratedClasses.php');
