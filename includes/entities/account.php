<?php

use PureFramework\ConstraintViolation;
use PureFramework\ErrorResponse;
use PureFramework\SuccessResponse;

function account_fetch_by_username(string $username): ?object
{
	$row = DB::fetchSingle('account', ['username' => $username]);

	return $row;
}

/**
 * @param array<string, mixed> $data Expects `username` and `password` (already transformed/validated by the caller)
 */
function account_create(array $data): SuccessResponse|ErrorResponse
{
	$invalid = AccountConstraint::runValidation([
		'username' => $data['username'] ?? '',
		'password' => $data['password'] ?? '',
	]);
	if ($invalid) {
		return new ErrorResponse('Validation failed', $invalid);
	}

	$username = $data['username'];
	$password = $data['password'];

	if (account_fetch_by_username($username) !== null) {
		return new ErrorResponse('That username is already taken.');
	}

	$account = DB::objectFactory('account', true, [
		'username' => $username,
		'password_hash' => password_hash($password, PASSWORD_DEFAULT),
	], 'account_uuid');

	$inserted = DB::insert('account', $account);
	if ($inserted === false) {
		return new ErrorResponse('Unable to create account');
	}

	return new SuccessResponse($account->account_uuid);
}

function account_create_error_message(ErrorResponse $response): string
{
	if (is_array($response->related)) {
		foreach ($response->related as $field => $violation) {
			if (!ConstraintViolation::isInstance($violation)) {
				continue;
			}

			$messages = $violation->getMessages(['label' => ucfirst((string) $field)]);
			if ($messages !== []) {
				return $messages[0];
			}
		}
	}

	if (is_string($response->data) && $response->data !== '') {
		return $response->data;
	}

	return 'Could not create account.';
}
