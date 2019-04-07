<?php

class User extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->user = $this->model('m_user');
		$this->data['title'] = 'User profile';
		$this->data['description'] = 'User profile';
	}


	public function index($username = null)
	{
		$user = $this->user;

		if ($username === null) {
			$this->redirect('');
			// $this->view('user/index', $data);
		}
		else {
			$this->data['user'] = $user->userInfo($username, 5);

			if ($this->data['user']->id) {
				$this->view('user/user-profile', $this->data);
			} else {
				$this->view('user/user-not-found', $this->data);
			}
		}
	}
}

?>