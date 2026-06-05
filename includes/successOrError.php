<?php

use PureFramework\ErrorResponse;
use PureFramework\SuccessResponse;

function success_or_error(bool $test, mixed $data = null, mixed $error = null, mixed $related = null): SuccessResponse|ErrorResponse
{
	if ($test) {
		return new SuccessResponse($data, $related);
	}

	return new ErrorResponse($error, $related);
}
