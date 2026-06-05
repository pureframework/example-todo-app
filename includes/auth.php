<?php

use PureFramework\Display;
use PureFramework\Session;

function auth_login(string $username, string $password): bool
{
	$account = account_fetch_by_username($username);
	if ($account === null) {
		return false;
	}

	if (!password_verify($password, $account->password_hash)) {
		return false;
	}

	$_SESSION['account_uuid'] = $account->account_uuid;
	$_SESSION['username'] = $account->username;
	Session::regenerate(deleteOld: true, regenerateCsrf: true);

	return true;
}

function auth_logout(): void
{
	unset($_SESSION['account_uuid'], $_SESSION['username']);
	Session::destroy(clearData: true);
}

function auth_is_logged_in(): bool
{
	return !empty($_SESSION['account_uuid']);
}

function auth_account_uuid(): ?string
{
	$uuid = $_SESSION['account_uuid'] ?? null;

	return is_string($uuid) && $uuid !== '' ? $uuid : null;
}

function auth_username(): string
{
	$name = $_SESSION['username'] ?? '';

	return is_string($name) ? $name : '';
}

function auth_require_logged_in(): void
{
	if (!auth_is_logged_in()) {
		Display::redirect('/login');
	}
}

function auth_require_guest(): void
{
	if (auth_is_logged_in()) {
		Display::redirect('/todos');
	}
}
