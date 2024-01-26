<?php

require_once __DIR__ . '/../boot.php';

$movieId = (int)($_GET["movieId"] ?? 0);
$genreCode = $_GET["genreCode"] ?? null;


$genres = getGenres();
$movie = getMovieByID($movieId);
$movies = getMovies($genreCode);

if (isset($movies[$movieId - 1]))
{
	$movie = $movies[$movieId - 1];
}
$mCount = count($movies);

if ($movieId > 0 && $movieId <= $mCount && is_numeric($movieId))
{
	echo view('/layout', [
		'sidebar' => view('/components/sidebar', ['genres' => $genres]),
		'toolbar' => view('/components/toolbar'),
		'content' => view('/pages/detail', ['movies' => $movies, 'movie' => $movie, 'genres' => $genres]),
	]);
}
else
{
	echo view('/layout', [
		'sidebar' => view('/components/sidebar', ['genres' => $genres]),
		'toolbar' => view('/components/toolbar'),
		'content' => view('/pages/empty-file'),
	]);
}