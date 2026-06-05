<?php

use PureFramework\Display;

if (auth_is_logged_in()) {
	Display::redirect('/todos');
}

Display::redirect('/login');
