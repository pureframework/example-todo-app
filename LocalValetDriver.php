<?php

use Valet\Drivers\BasicValetDriver;

/**
 * Route all requests through htdocs/index.php (never nested handler files).
 * Park the site at the project root (example-todo-app/), not htdocs/.
 */
class LocalValetDriver extends BasicValetDriver
{
	private function htdocsPath(string $sitePath): string
	{
		return rtrim($sitePath, '/\\') . '/htdocs';
	}

	public function serves(string $sitePath, string $siteName, string $uri): bool
	{
		return is_file($this->htdocsPath($sitePath) . '/index.php');
	}

	public function isStaticFile(string $sitePath, string $siteName, string $uri): string|false
	{
		$root = $this->htdocsPath($sitePath);

		if (str_ends_with($uri, '.css') && is_file($path = $root . $uri)) {
			return $path;
		}

		if (!str_ends_with($uri, '.scss') && str_contains($uri, '/assets/') && is_file($path = $root . $uri)) {
			return $path;
		}

		return false;
	}

	public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
	{
		$root = $this->htdocsPath($sitePath);
		$index = $root . '/index.php';

		if (!is_file($index)) {
			return null;
		}

		$_SERVER['SCRIPT_FILENAME'] = $index;
		$_SERVER['SCRIPT_NAME'] = '/index.php';
		$_SERVER['DOCUMENT_ROOT'] = $root;

		return $index;
	}
}
