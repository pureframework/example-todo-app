<?php

use PureFramework\Csrf;
use PureFramework\Display;
use PureFramework\Form;
use PureFramework\TrimTransform;

auth_require_guest();

$form = new Form();
$form->addField('username', 'Username', [new TrimTransform()], [(new AccountConstraint())->forField('username')]);
$form->addField('password', 'Password', [], [(new AccountConstraint())->forField('password')]);

$loginError = null;

if ($REQUEST->isPost()) {
	if (!Csrf::verify($REQUEST)) {
		http_response_code(403);
		exit;
	}

	$form->setValues($REQUEST->postAll());
	$form->transformValues();

	if ($form->validate()) {
		$values = $form->getValues();
		if (auth_login($values['username'], $values['password'])) {
			Display::redirect('/todos');
		}
		$loginError = 'Invalid username or password.';
	}
}

Display::page('form.tpl.php', [
	'title' => 'Log in',
	'form' => $form,
	'loginError' => $loginError,
]);
