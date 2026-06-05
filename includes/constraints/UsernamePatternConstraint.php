<?php

use PureFramework\ConstraintType;
use PureFramework\ConstraintViolation;

final class UsernamePatternConstraint extends ConstraintType
{
	public function validate($value, $args = null, $context = null)
	{
		$str = is_string($value) ? $value : '';

		if (!preg_match('/^[a-zA-Z0-9_]{3,32}$/', $str)) {
			return new ConstraintViolation(
				'username_pattern',
				'{label} must be 3–32 letters, numbers, or underscores',
				array_merge($this->args($args), ['value' => $value]),
			);
		}
	}
}
