<?php

function truncate(?string $text, ?int $maxLength = null): string
{

	if ($maxLength === null)
	{
		return $text;
	}

	$cropped = mb_substr($text, 0, $maxLength, 'UTF-8');

	if ($cropped !== $text)
	{
		return "$cropped...";
	}

	return $text;
}

function formatDuration(array $movie): string
{
	return date('G:i', mktime(0, $movie['duration']));
}