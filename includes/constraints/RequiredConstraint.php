<?php

use PureFramework\ConstraintType;
use PureFramework\ConstraintViolation;

final class RequiredConstraint extends ConstraintType
{
	public function validate($value, $args = null, $context = null)
	{
		if ($value === null || $value === '') {
			$mergedArgs = array_merge(is_array($args) ? $args : [], ['value' => $value]);

			return new ConstraintViolation('required', '{label} is required', $mergedArgs);
		}
	}
}
