<?php

use PureFramework\Csrf;
use function PureFramework\html;

$this->set('pageTitle', $title ?? 'My todos');
?>
<h1>My todos</h1>

<?php if (!empty($addTodoError)) : ?>
	<p class="error"><?php echo html($addTodoError); ?></p>
<?php endif; ?>

<form method="post" action="/todos" class="add-todo">
	<?php echo Csrf::field(); ?>
	<label>
		<span class="visually-hidden"><?php echo html($form->getField('title')->label); ?></span>
		<input type="text" name="title" value="<?php echo html($form->getValue('title')); ?>" placeholder="What needs to be done?" maxlength="255" required>
	</label>
	<?php $fieldName = 'title';
	require dirname(__DIR__, 2) . '/templates/partials/form-errors.php'; ?>
	<button type="submit">Add</button>
</form>

<?php if (empty($todos)) : ?>
	<p>No todos yet. Add one above.</p>
<?php else : ?>
	<ul class="todo-list">
		<?php foreach ($todos as $todo) :
			$done = $todo->completed_at !== null && $todo->completed_at !== '';
			$uuid = $todo->todo_uuid;
			?>
			<li class="todo-item<?php echo $done ? ' done' : ''; ?>">
				<span class="todo-title"><?php echo html($todo->title); ?></span>
				<span class="todo-actions">
					<form method="post" action="/todos/<?php echo html($uuid); ?>/toggle">
						<?php echo Csrf::field(); ?>
						<button type="submit"><?php echo $done ? 'Undo' : 'Done'; ?></button>
					</form>
					<form method="post" action="/todos/<?php echo html($uuid); ?>/delete">
						<?php echo Csrf::field(); ?>
						<button type="submit">Delete</button>
					</form>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
