<?php

require_once __DIR__ . '/../boot.php';

$genreCode = $_GET["genreCode"] ?? null;
$genres = getGenres();
$movies = getMovies($genreCode);

echo view('/layout', [
	'sidebar' => view('/components/sidebar', ['genres' => $genres]),
	'toolbar' => view('/components/toolbar'),
	'content' => view('/pages/index', ['movies' => $movies, 'genres' => $genres]),
]);