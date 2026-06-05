<?php

define('NO_SESSION', true);

require dirname(__DIR__) . '/init.php';

$files = [
	dirname(__DIR__) . '/sql/account.sql',
	dirname(__DIR__) . '/sql/todo.sql',
];

$pdo = DB::connection();
if ($pdo === false) {
	fwrite(STDERR, "Could not connect using PURE_DB_CONNECTION. Create the database first, then run this script.\n");
	exit(1);
}

foreach ($files as $file) {
	if (!is_file($file)) {
		fwrite(STDERR, "Missing SQL file: {$file}\n");
		exit(1);
	}

	$sql = file_get_contents($file);
	if ($sql === false) {
		fwrite(STDERR, "Could not read: {$file}\n");
		exit(1);
	}

	echo 'Running ' . basename($file) . "...\n";
	$pdo->exec($sql);
}

$demoUser = 'demo';
$existing = DB::fetchSingle('account', ['username' => $demoUser]);
if ($existing === null) {
	$result = account_create(['username' => $demoUser, 'password' => 'demo12345']);
	if ($result->isSuccess()) {
		echo "Created demo account: username \"{$demoUser}\", password \"demo12345\"\n";
	} elseif ($result->isError()) {
		fwrite(STDERR, 'Could not create demo account: ' . account_create_error_message($result) . "\n");
	}
} else {
	echo "Demo account \"{$demoUser}\" already exists.\n";
}

echo "Database setup complete.\n";
