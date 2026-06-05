<?php

use PureFramework\ConstraintType;
use PureFramework\ConstraintViolation;

/**
 * Ensures this field's value matches another field in the same form.
 * Pass $context['values'] from Form::validate() (all current form values).
 */
final class EqualFieldsConstraint extends ConstraintType
{
	public function __construct(string $otherField, string $otherLabel = '')
	{
		parent::__construct([
			'otherField' => $otherField,
			'otherLabel' => $otherLabel !== '' ? $otherLabel : $otherField,
		]);
	}

	public function validate($value, $args = null, $context = null)
	{
		$opts = $this->args($args);

		if (!is_array($context) || !isset($context['values']) || !is_array($context['values'])) {
			return null;
		}

		$otherField = (string) ($opts['otherField'] ?? '');
		$otherValue = $context['values'][$otherField] ?? '';

		if ($value !== $otherValue) {
			return new ConstraintViolation(
				'equal_fields',
				'{label} must match {otherLabel}',
				array_merge($opts, ['value' => $value]),
			);
		}
	}
}
