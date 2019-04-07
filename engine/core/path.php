<?php

class Path
{
	public static function parseUrl()
	{
		if (isset($_GET['url']))
		{
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
	
	public static function relativePath()
	{
		$count_r_path = substr_count(DIR_WS_SITE, '/');
		$actual_path = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$count_a_path = substr_count($actual_path, '/');

		$diff = $count_a_path - $count_r_path;
		$result = '';

		while ($diff > 0) {
			$result .= '../';
			$diff--;
		}

		return $result;
	}
}

?>