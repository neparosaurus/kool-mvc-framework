<?php

class Register extends Controller
{
	public function index()
	{
		$this->data['title'] = 'Registration form';

		$user = $this->model('m_user');
		$this->data['users'] = $user->listUsers();

		if ($this->data['post_params'] = $this->post())
		{
			$this->checkRegister();
		}

		$this->view('register/index', $this->data);
	}

	private function checkRegister()
	{
		$validation = $this->core('validation');

		$rules = array(
			'username' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 32,
				'unique'	=> 'users',
				'charset'	=> 1
				),
			'password' => array(
				'required'	=> true,
				'min'		=> 6,
				'max'		=> 32,
				'charset'	=> 1
				),
			'password_again' => array(
				'required'	=> true,
				'matches'	=> 'password',
				'charset'	=> 1
				),
			'name' => array(
				'required'	=> true,
				'min'		=> 3,
				'max'		=> 32,
				'charset'	=> 2
				)
		);

		$validation->check($this->data['post_params'], $rules);

		if ($validation->passed())
		{
			$user = $this->model('m_user');

			$salt = salt(8);

			$user_items = array(
				'username'	=> $this->data['post_params']['username'],
				'password'	=> hash('md5', $this->data['post_params']['password'].$salt),
				'salt'		=> $salt,
				'name'		=> $this->data['post_params']['name'],
				'joined'	=> date("Y-m-d H:i:s"),
				'group'	=> 1
			);
			
			$registered = $user->registerUser($user_items);

			if ($registered) {
				$this->data['reg_success'] = 'Registration successfully';
			} else {
				$this->data['reg_errors'] = array('Can\'t register right now');
			}

		} else {
			$this->data['reg_errors'] = $validation->errors();
		}
	}
}

?>