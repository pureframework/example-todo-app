<?php

use PureFramework\Session;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

if (!defined('NO_SESSION')) {
	$secure = defined('APP_ENV') && APP_ENV === 'production';

	Session::configureCookieParams([
		'lifetime' => 0,
		'secure' => $secure,
		'httponly' => true,
		'samesite' => 'Lax',
	]);

	Session::start();
}

require __DIR__ . '/includes/index.php';
