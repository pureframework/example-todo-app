<?php

use PureFramework\Csrf;
use function PureFramework\html;

?>
<header id="site-header">
	<strong><a href="/">Example Todo App</a></strong>
	<nav>
		<?php if (auth_is_logged_in()) : ?>
			<span class="nav-user"><?php echo html(auth_username()); ?></span>
			<form method="post" action="/logout" class="nav-logout">
				<?php echo Csrf::field(); ?>
				<button type="submit">Log out</button>
			</form>
		<?php else : ?>
			<a href="/login">Log in</a>
			<a href="/register">Register</a>
		<?php endif; ?>
	</nav>
</header>
