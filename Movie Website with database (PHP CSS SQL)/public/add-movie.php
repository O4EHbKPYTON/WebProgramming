<?php

require_once __DIR__ . '/../boot.php';

/**
 * @var array $genres
 */
$genres=getGenres();

echo view('/layout', [
	'sidebar' => view('/components/sidebar', ['genres' => $genres]),
	'toolbar' => view('/components/toolbar'),
	'content' => view('/pages/add-movie',),
]);