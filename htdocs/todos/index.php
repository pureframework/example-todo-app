<?php

use PureFramework\Csrf;
use PureFramework\Display;
use PureFramework\Form;
use PureFramework\TrimTransform;

auth_require_logged_in();

$accountUuid = auth_account_uuid();

$form = new Form();
$form->addField('title', 'Title', [new TrimTransform()], [(new TodoConstraint())->forField('title')]);

$addTodoError = null;

if ($REQUEST->isPost()) {
	if (!Csrf::verify($REQUEST)) {
		http_response_code(403);
		exit;
	}

	$form->setValues($REQUEST->postAll());
	$form->transformValues();

	if ($form->validate()) {
		$result = todo_create($accountUuid, $form->getValues());

		if ($result->isSuccess()) {
			Display::redirect('/todos');
		} elseif ($result->isError()) {
			$addTodoError = todo_create_error_message($result);
		}
	}
}

$todos = todo_list_for_account($accountUuid);

Display::page('list.tpl.php', [
	'title' => 'My todos',
	'todos' => $todos,
	'form' => $form,
	'addTodoError' => $addTodoError,
]);
