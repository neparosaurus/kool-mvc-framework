<?php
if (!defined("SECURE")) exit("No direct script access allowed");

//
// Core Controller functions
//

class Controller
{
	public $data = array(
		'title' 		=> 'Websajd barabo',
		'description' 	=> 'Something about us'
	);


	// Load model (/models)
	protected function model($model)
	{
		require_once '../engine/models/'.$model.'.php';
		return new $model();
	}

	// Load view (/view)
	protected function view($view, $data = [])
	{
		if (!isset($data['title']))
			$data['title'] = $this->data['title'];

		require_once '../engine/views/'.$view.'.php';
	}

	// Load core (/core)
	protected function core($core)
	{
		require_once '../engine/core/'.$core.'.php';
		return new $core();
	}

	// $_GET parameters (if empty, get ALL parameters)
	protected function get($param = null)
	{
		if ($param === null) {
			$results = $_GET;
			unset($results['url']);
			return $results;
		}
		else {
			return array($_GET[$param]);
		}
	}

	// $_POST parameters (if empty, get ALL parameters)
	protected function post($param = null)
	{
		if ($param === null) {
			$results = $_POST;
			return $results;
		}
		else {
			return array($_POST[$param]);
		}
	}

	protected function redirect($page = null)
	{
		header('Location: '.DIR_WS_SITE.$page);
	}



	/*
	protected function load($folder, $file)
	{
		echo $folder.' '.$file.'<br />';

		if(property_exists($this, $file))
        {
            return $this->{$file};
        }

        $path = $_SERVER['DOCUMENT_ROOT'].'Hoof/engine/'.$folder.'/'.$file.'.php';

        //library file not found
        if(!file_exists($path))
        {
            exit('library not found');
        }

        //include the library file
        include($path);

        //instanciate the library dynamicly
        $class = new $file();

        //assign the class object to a Core class property
        $this->{$file} = $class;
	}
	*/
}

?>