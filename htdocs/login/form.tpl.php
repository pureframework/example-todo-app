<?php

use function PureFramework\html;

$this->set('pageTitle', $title ?? 'Log in');
?>
<h1>Log in</h1>

<?php if (!empty($loginError)) : ?>
	<p class="error"><?php echo html($loginError); ?></p>
<?php endif; ?>

<form method="post" class="stack">
	<?php echo PureFramework\Csrf::field(); ?>

	<label>
		<?php echo html($form->getField('username')->label); ?>
		<input type="text" name="username" value="<?php echo html($form->getValue('username')); ?>" autocomplete="username" required>
	</label>
	<?php $fieldName = 'username';
	require dirname(__DIR__, 2) . '/templates/partials/form-errors.php'; ?>

	<label>
		<?php echo html($form->getField('password')->label); ?>
		<input type="password" name="password" autocomplete="current-password" required>
	</label>
	<?php $fieldName = 'password';
	require dirname(__DIR__, 2) . '/templates/partials/form-errors.php'; ?>

	<p><button type="submit">Log in</button></p>
	<p>No account? <a href="/register">Register</a></p>
</form>
