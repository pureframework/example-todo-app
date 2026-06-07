<?php

use PureFramework\ConstraintViolation;
use PureFramework\ErrorResponse;
use PureFramework\Response;
use PureFramework\SuccessResponse;

function todo_list_for_account(string $accountUuid): array
{
	$rows = DB::fetch('todo', ['account_uuid' => $accountUuid]);
	if (!is_array($rows)) {
		return [];
	}

	usort($rows, static function ($a, $b): int {
		return strcmp($b->created, $a->created);
	});

	return $rows;
}

function todo_fetch_for_account(string $accountUuid, string $todoUuid): ?object
{
	return DB::fetchSingle('todo', [
		'todo_uuid' => $todoUuid,
		'account_uuid' => $accountUuid,
	]);
}

/**
 * @param array<string, mixed> $data Expects at least `title` (already transformed/validated by the caller)
 */
function todo_create(string $accountUuid, array $data): SuccessResponse|ErrorResponse
{
	$invalid = TodoConstraint::runValidation($data);
	if ($invalid) {
		return new ErrorResponse('Validation failed', $invalid);
	}

	$title = $data['title'];

	$todo = DB::objectInsertFactory('todo', [
		'account_uuid' => $accountUuid,
		'title' => $title,
	]);

	$inserted = DB::insert('todo', $todo);
	if ($inserted === false) {
		return new ErrorResponse('Unable to save todo');
	}

	return new SuccessResponse($todo->todo_uuid);
}

/**
 * First human-readable message from a failed todo_create() response.
 */
function todo_create_error_message(Response $response): string
{
	if (!$response->isError()) {
		return 'Could not add todo.';
	}
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

	return 'Could not add todo.';
}

function todo_toggle(string $accountUuid, string $todoUuid): bool
{
	$row = todo_fetch_for_account($accountUuid, $todoUuid);
	if ($row === null) {
		return false;
	}

	$completedAt = $row->completed_at !== null && $row->completed_at !== ''
		? null
		: date('Y-m-d H:i:s');

	$patch = DB::objectUpdateFactory('todo', [
		'completed_at' => $completedAt,
	]);

	return DB::update('todo', $patch, ['todo_uuid' => $todoUuid]) !== false;
}

function todo_delete(string $accountUuid, string $todoUuid): bool
{
	$row = todo_fetch_for_account($accountUuid, $todoUuid);
	if ($row === null) {
		return false;
	}

	DB::delete('todo', ['todo_uuid' => $todoUuid]);

	return true;
}
