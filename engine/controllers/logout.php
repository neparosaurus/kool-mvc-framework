<?php

class Logout extends Controller
{
	public function index()
	{
		unset($_SESSION['username']);

		$this->view('login/index', $this->data);
	}
}