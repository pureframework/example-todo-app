<?php

class DB extends \PureFramework\DB
{
	use \PureFramework\UuidDbTrait;

	public static function log($msg): void
	{
		if (defined('APP_ENV') && APP_ENV === 'development') {
			error_log($msg);
		}
	}
}
