<?php

use function PureFramework\html;

$this->set('pageTitle', $title ?? 'Register');
?>
<h1>Register</h1>

<?php if (!empty($formError)) : ?>
	<p class="error"><?php echo html($formError); ?></p>
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
		<input type="password" name="password" autocomplete="new-password" required>
	</label>
	<?php $fieldName = 'password';
	require dirname(__DIR__, 2) . '/templates/partials/form-errors.php'; ?>

	<label>
		<?php echo html($form->getField('password_confirm')->label); ?>
		<input type="password" name="password_confirm" autocomplete="new-password" required>
	</label>
	<?php $fieldName = 'password_confirm';
	require dirname(__DIR__, 2) . '/templates/partials/form-errors.php'; ?>

	<p><button type="submit">Create account</button></p>
	<p>Already have an account? <a href="/login">Log in</a></p>
</form>
