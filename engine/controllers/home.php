<?php

class Home extends Controller
{
	public function index()
	{
		$this->data['title'] = "Home page";
		$this->data['name'] = 'Nikola Aleksic';
		
		$this->view('home/index', $this->data);
	}

	public function test_model($name = '')
	{
		$user = $this->model('User');
		$user->name = $name;

		$this->view('home/index', ['name' => $user->name]);
	}

	public function test_load()
	{
		$this->load('models', 'user');
		$this->user->u_test();
	}
}

?>