<?php
/**
 * @var array $genres
 * @var array $rows
 */

$menuItems = option('MENU_ITEMS', [
	'index' => 'Главная',
	'favorite' => 'Избранное',
])

?>

<header class="sidebar">
	<a href="/" class="logo-link">
		<img src="img/img.svg" alt="logo">
	</a>
	<nav class="menu">
		<ul>
			<?php
			foreach ($menuItems as $key => $menuItem)
			{
				?>
				<li class="menu-item"><a href="/<?= $key ?>.php" class="menu-link"><?= $menuItem ?></a></li>
				<?php
			}
			?>
			<?php
			foreach ($genres as $keys => $genre)
			{

				?>
				<li class="menu-item"><a href="/?genreCode=<?= $keys  ?>" class="menu-link"><?= $genre['name'] ?></a></li>
				<?php
			}
			?>
		</ul>
	</nav>
</header>