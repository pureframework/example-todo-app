<?php

use PureFramework\Csrf;
use PureFramework\Display;
auth_require_logged_in();

if (!$REQUEST->isPost()) {
	Display::redirect('/todos');
}

if (!Csrf::verify($REQUEST)) {
	http_response_code(403);
	exit;
}

$todoUuid = $REQUEST->uuidParam('todo_uuid');
if ($todoUuid === false) {
	Display::notFound();
}

$accountUuid = auth_account_uuid();

if (!todo_toggle($accountUuid, $todoUuid)) {
	Display::notFound();
}

Display::redirect('/todos');
