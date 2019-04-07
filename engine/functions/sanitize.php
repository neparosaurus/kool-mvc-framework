<?php

function escape($string)
{
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function isSafe($string, $charset)
{
	/*
	Charset variantes:
	1 - Username, password, etc
	2 - First name, last name, etc
	3 - Email
	4 - Numbers
	*/

	$allowed = array(
		1 => '/^[a-zA-Z0-9]+$/',
		2 => '/^[a-zA-Z ]+$/',
		3 => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
		4 => '/[^0-9]/'
	);

	if (array_key_exists($charset, $allowed) && preg_match($allowed[$charset], $string) === 1) {
		return true;
	}
	else {
		return false;
	}
}

function salt($length)
{
	// return mcrypt_create_iv($length);
	return substr(md5(mcrypt_create_iv(8)), 0, $length);
}

