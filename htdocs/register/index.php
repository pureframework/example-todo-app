<?php

use PureFramework\Csrf;
use PureFramework\Display;
use PureFramework\Form;
use PureFramework\TrimTransform;

auth_require_guest();

$form = new Form();
$form->addField('username', 'Username', [new TrimTransform()], [(new AccountConstraint())->forField('username')]);
$form->addField('password', 'Password', [], [(new AccountConstraint())->forField('password')]);
$form->addField('password_confirm', 'Confirm password', [], [
	new RequiredConstraint(),
	new EqualFieldsConstraint('password', 'Password'),
]);

$formError = null;

if ($REQUEST->isPost()) {
	if (!Csrf::verify($REQUEST)) {
		http_response_code(403);
		exit;
	}

	$form->setValues($REQUEST->postAll());
	$form->transformValues();

	if ($form->validate([], ['values' => $form->getValues()])) {
		$values = $form->getValues();
		$result = account_create($values);

		if ($result->isSuccess()) {
			auth_login($values['username'], $values['password']);
			Display::redirect('/todos');
		} elseif ($result->isError()) {
			$formError = account_create_error_message($result);
		}
	}
}

Display::page('form.tpl.php', [
	'title' => 'Register',
	'form' => $form,
	'formError' => $formError,
]);
