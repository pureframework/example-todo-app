<?php

use PureFramework\ConstraintEntity;

final class AccountConstraint extends ConstraintEntity
{
	public function __construct()
	{
		$this->defineField('username', [
			new RequiredConstraint(),
			new UsernamePatternConstraint(),
		]);

		$this->defineField('password', [
			new RequiredConstraint(),
			new MinLengthConstraint(8),
		]);
	}
}
