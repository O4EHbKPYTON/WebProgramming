<?php

/**
 *
 * @var array $movies ;
 * @var array $movie ;
 */

// $movieId = (int)$_GET["movieId"];
// $movie = $movies[$movieId - 1];

?>


<section class="content">
	<div class="movie">
		<div class="header">
			<div class="titles">
				<div class="title-detail"><?= $movie['title'] ?> (<?= $movie['release_date'] ?>)</div>
				<div class="english-title-detail">
					<?= $movie['original_title'] ?>
					<div class="img-detail"></div>
				</div>
			</div>
			<div class="like"></div>
		</div>
		<div class="poster-detail">
			<img class="img" src="/img/<?= $movie['id'] ?>.jpg">
		</div>
		<div class="about">
			<div class="rating">
				<ul class="meter">
					<?php
					for ($i = 0; $i < 10; $i++) : ?>
						<?php
						if ($i < floor($movie['rating'])) : ?>
							<li class="square">
								<img src="img/full-square.svg">
							</li>
						<?php
						else : ?>
							<li class="square">
								<img src="img/empty-square.svg">
							</li>
						<?php
						endif ?>
					<?php
					endfor; ?>
				</ul>
				<div class="ellipse">
					<div class="num">
						<?= sprintf("%.1f", $movie['rating']) ?>
					</div>
				</div>
			</div>
			<div class="film">О фильме</div>
			<table class="prod">
				<tr>
					<th class="table-header">Год производства:</th>
					<td class="table-text"><?= $movie['release_date'] ?></td>
				</tr>
				<tr>
					<th class="table-header">Режиссер:</th>
					<td class="table-text"><?= $movie['director'] ?></td>
				</tr>
				<tr>
					<th class="table-header">В главных ролях:</th>
					<td class="table-text"><?= implode(", ", $movie['cast']) ?></td>
				</tr>
			</table>
			<div class="description-name">
				Описание
			</div>
			<div class="description-detail"><?= $movie['description'] ?></div>
		</div>
	</div>
</section>