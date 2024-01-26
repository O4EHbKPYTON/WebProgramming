<?php
/** @var string $sidebar
 ** @var string $toolbar
 ** @var string $content
 * */

?>

<!doctype html>
<html lang="<?= option('APP_LANG', 'ru') ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= option('APP_NAME', 'Bitflix') ?></title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body class="body">
<div class="wrapper">

	<?= $sidebar ?>
	<?= $toolbar ?>
	<?= $content ?>
</div>


</body>
</html>