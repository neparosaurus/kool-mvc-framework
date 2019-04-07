<?php
if (!defined("SECURE")) exit("No direct script access allowed");

class Core
{
	protected $controller = 'home';
	protected $method = 'index';
	protected $params = [];


	public function __construct()
	{
		$url = Path::parseUrl();

		if (isset($url[0]))
		{
			if (file_exists('../engine/controllers/'.$url[0].'.php'))
				$this->controller = $url[0];
			else
				$this->controller = 'error_404';

			unset($url[0]);
		}
		require_once '../engine/controllers/'.$this->controller.'.php';
		$this->controller = new $this->controller;

		if (isset($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);
	}
}

?>