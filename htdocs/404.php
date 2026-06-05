<?php

http_response_code(404);

use PureFramework\Display;

Display::page('404.tpl.php', [
	'title' => 'Page not found',
]);
