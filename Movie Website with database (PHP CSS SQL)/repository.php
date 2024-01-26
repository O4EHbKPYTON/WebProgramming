<?php

function getGenres(): array
{
	$connection = getDbConnection();

	$result = mysqli_query(
		$connection,
		"
			SELECT * FROM genre
			LIMIT 100
			"
	);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}
	$genres = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$genres[$row['CODE']] = [
			'code' => $row['CODE'],
			'id' => $row['ID'],
			'name' => $row['NAME'],
		];
	}

	return $genres;
}

function getMoviesDirectors(): array
{
	$connection = getDbConnection();

	$db = option('DB_NAME');

	$result = mysqli_query(
		$connection,
		"
			SELECT movie.ID,NAME FROM movie
			left outer join $db.director d on d.ID = movie.DIRECTOR_ID
			ORDER BY movie.ID
			LIMIT 100
			"
	);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}
	$movieDirector = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$movieDirector[$row['MOVIE_ID']][] = $row['NAME'];
	}

	return $movieDirector;
}

function getMoviesGenresId(): array
{
	$connection = getDbConnection();

	$result = mysqli_query(
		$connection,
		"
			SELECT MOVIE_ID,GENRE_ID FROM movie_genre
			LIMIT 100
			"
	);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}
	$movieGenre = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$movieGenre[$row['MOVIE_ID']][] = $row['GENRE_ID'];
	}

	return $movieGenre;
}

function getMoviesActors(): array
{
	$connection = getDbConnection();

	$db = option('DB_NAME');

	$result = mysqli_query(
		$connection,
		"
			SELECT MOVIE_ID,NAME FROM movie_actor
			left join $db.actor a on a.ID = movie_actor.ACTOR_ID
			ORDER BY MOVIE_ID
			LIMIT 100
			"
	);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}
	$movieActor = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$movieActor[$row['MOVIE_ID']][] = $row['NAME'];
	}

	return $movieActor;
}

function getMovieByID($ID = null): array
{

	$connection = getDbConnection();

	$IdEscaped = mysqli_real_escape_string($connection, $ID);

	$filteredByIdMovieQuery = "
		SELECT * FROM movie 
		WHERE ID = '" . $IdEscaped . "' ";

	$unfilteredMoviesQuery = "SELECT * FROM movie";

	if ($ID === null)
	{
		$result = mysqli_query($connection, (string)$unfilteredMoviesQuery);
	}
	else
	{
		$result = mysqli_query($connection, $filteredByIdMovieQuery);
	}

	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$movies = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$movies[] = [
			'id' => (int)$row['MOVIE_ID'],
			'title' => $row['TITLE'],
			'original_title' => $row['ORIGINAL_TITLE'],
			'description' => $row['DESCRIPTION'],
			'duration' => $row['DURATION'],
			'age_restriction' => $row['AGE_RESTRICTION'],
			'release_date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING'],
			'director_id' => $row['DIRECTOR_ID']
		];
	}

	return $movies;
}

function getMovies($code = null): array
{
	$connection = getDbConnection();

	$db = option('DB_NAME');

	$codeEscaped = mysqli_real_escape_string($connection, $code);

	$filteredByGenresMoviesQuery = "SELECT movie.ID,TITLE,ORIGINAL_TITLE,DESCRIPTION,DURATION,AGE_RESTRICTION,RELEASE_DATE,RATING,CODE,NAME FROM movie
			left join $db.movie_genre mg on movie.ID = mg.MOVIE_ID
			inner join $db.genre g on mg.GENRE_ID = g.ID
			WHERE CODE = '" . $codeEscaped . "'";

	$unfilteredMoviesQuery = "SELECT * FROM movie";

	if ($code === null)
	{
		$result = mysqli_query($connection, $unfilteredMoviesQuery);
	}
	else
	{
		$result = mysqli_query($connection, $filteredByGenresMoviesQuery);
	}
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$movies = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$movies[] = [
			'id' => (int)$row['ID'],
			'title' => $row['TITLE'],
			'original_title' => $row['ORIGINAL_TITLE'],
			'description' => $row['DESCRIPTION'],
			'duration' => $row['DURATION'],
			'age_restriction' => $row['AGE_RESTRICTION'],
			'release_date' => $row['RELEASE_DATE'],
			'rating' => $row['RATING'],
			'director_id' => $row['DIRECTOR_ID']
		];
	}

	$genresName = [];

	foreach (getGenres() as $genre)
	{
		$genresName[$genre['id']] = $genre['name'];
	}

	$movieGenres = getMoviesGenresId();

	foreach ($movieGenres as $movieId => $genres)
	{
		if (array_key_exists($movieId - 1, $movies))
		{
			$movies[$movieId - 1]['genres'] = [];
			foreach ($genres as $genre)
			{
				$movies[$movieId - 1]['genres'][] = $genresName[$genre];
			}
		}
	}

	$movieActors = getMoviesActors();

	foreach ($movieActors as $movieId => $actors)
	{
		if (array_key_exists($movieId - 1, $movies))
		{
			$movies[$movieId - 1]['cast'] = $actors;
		}
	}

	$Directors = getMoviesDirectors();

	$movieDirectors = reset($Directors);

	foreach ($movieDirectors as $movieId => $directors)
	{
		if (array_key_exists($movieId, $movies))
		{
			$movies[$movieId]['director'] = $directors;
		}
	}

	return $movies;

}