<?php

use PureFramework\Form;
use function PureFramework\html;

/** @var Form $form */
/** @var string $fieldName */
foreach ($form->getFieldErrors($fieldName) as $error) {
	foreach ($error->getMessages() as $message) {
		echo '<p class="error">' . html($message) . '</p>';
	}
}
