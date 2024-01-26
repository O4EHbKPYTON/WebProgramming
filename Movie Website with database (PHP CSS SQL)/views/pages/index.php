<?php
/**
 * @var array $movies
 * @var array $genres
 * @var string $code
 */

?>
<section class="content">

	<?php
	foreach ($movies as $movie):
		?>
		<?php
		array_splice($movie['genres'], 3) ?>

		<div class="movie-item">
			<div>
				<img class="poster" src="/img/<?= $movie['id'] ?>.jpg" alt="logo">
			</div>
			<div class="description">
				<div class="title"><a title="<?= $movie['title'] ?>"><?= $movie['title'] ?></a></div>
				<div class="english-title"><?= $movie['original_title'] ?></div>
				<div class="synopsis"><?= truncate($movie['description'], option('TRUNCATE_DESCRIPTION', 200)) ?></div>
				<div class="additional">
					<div class="clock"></div>
					<div class="duration"><?= $movie['duration'] ?> мин. / <?= formatDuration($movie) ?>
					</div>
					<div class="genre"><?= implode(", ", $movie['genres']) ?></div>
				</div>
			</div>
			<div class="movie-item-hover">
				<div class="button">
					<a href="/detail.php?movieId=<?= $movie['id'] ?>" class="details">
						Подробнее
					</a>
				</div>
			</div>
		</div>
	<?php
	endforeach;
	?>

</section>