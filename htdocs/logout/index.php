<?php

use PureFramework\Csrf;
use PureFramework\Display;

if (!$REQUEST->isPost()) {
	Display::redirect('/login');
}

if (!Csrf::verify($REQUEST)) {
	http_response_code(403);
	exit;
}

auth_logout();
Display::redirect('/login');
