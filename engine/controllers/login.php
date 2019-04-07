<?php

class Login extends Controller
{
	public function index()
	{
		$this->data['title'] = 'Login form';

		$user = $this->model('m_user');
		$this->data['users'] = $user->listUsers();

		if ($this->data['post_params'] = $this->post())
		{
			$this->checkLogin();
		}

		$this->view('login/index', $this->data);
	}

	/*
	*	Validate user input on login
	*/
	private function checkLogin()
	{
		$validation = $this->core('validation');

		$rules = array(
			'username' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 32,
				'charset'	=> 1
				),
			'password' => array(
				'required'	=> true,
				'min'		=> 6,
				'max'		=> 32,
				'charset'	=> 1
				)
		);

		$validation->check($this->data['post_params'], $rules);

		if ($validation->passed())
		{
			$user = $this->model('m_user');

			$user_items = array(
				'username'	=> $this->data['post_params']['username'],
				'password'	=> $this->data['post_params']['password']
			);
			
			$login = $user->loginCheck($user_items);

			if ($login) {
				$this->data['log_success'] = 'Login successfully';
				$_SESSION['username'] = $user_items['username'];
			} else {
				$this->data['log_errors'] = array('Can\'t login right now');
			}

		} else {
			$this->data['log_errors'] = $validation->errors();
		}
	}
}

?>