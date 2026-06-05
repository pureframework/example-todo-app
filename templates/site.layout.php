<?php use function PureFramework\html; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo html($title ?? 'Example Todo App'); ?></title>
	<link rel="stylesheet" href="/assets/styles.css">
</head>

<body>
	<?php echo $header; ?>
	<main id="site-content"><?php echo $content; ?></main>
	<?php echo $footer; ?>
</body>

</html>