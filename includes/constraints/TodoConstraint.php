<?php

use PureFramework\ConstraintEntity;

final class TodoConstraint extends ConstraintEntity
{
	public function __construct()
	{
		$this->defineField('title', [
			new RequiredConstraint(),
			new MinLengthConstraint(1),
		]);
	}
}
