<?php

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/constraints/RequiredConstraint.php';
require_once __DIR__ . '/constraints/EqualFieldsConstraint.php';
require_once __DIR__ . '/constraints/MinLengthConstraint.php';
require_once __DIR__ . '/constraints/UsernamePatternConstraint.php';
require_once __DIR__ . '/constraints/AccountConstraint.php';
require_once __DIR__ . '/constraints/TodoConstraint.php';
require_once __DIR__ . '/successOrError.php';

if (is_file(__DIR__ . '/dbGeneratedClasses.php')) {
	require_once __DIR__ . '/dbGeneratedClasses.php';
}

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/entities/account.php';
require_once __DIR__ . '/entities/todo.php';
