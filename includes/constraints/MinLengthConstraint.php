<?php

use PureFramework\ConstraintType;
use PureFramework\ConstraintViolation;

final class MinLengthConstraint extends ConstraintType
{
	public function __construct(int $min = 1)
	{
		parent::__construct(['min' => $min]);
	}

	public function validate($value, $args = null, $context = null)
	{
		$opts = $this->args($args);
		$min = (int) ($opts['min'] ?? 1);
		$str = is_string($value) ? $value : '';

		if (strlen($str) < $min) {
			return new ConstraintViolation(
				'min_length',
				'{label} must be at least {min} characters',
				array_merge($opts, ['value' => $value, 'min' => $min]),
			);
		}
	}
}
