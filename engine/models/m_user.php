<?php

class m_user extends Model
{
	public function __construct() {	} // Not gonna work if constructor is private

	public function listUsers()
	{
		$result = Model::getInstance()->query("SELECT * FROM users");
		$users = array();

		if ($result->count()) {
			foreach ($result->results() as $user) {
				array_push($users, $user->username);
			}
		}

		return $users;
	}

	public function userExist($username)
	{
		$result = Model::getInstance()->query("SELECT * FROM users WHERE username = ? LIMIT 1", [$username]);
		$users = array();

		if ($this->count = $result->count()) {
			foreach ($result->results() as $user) {
				array_push($users, $user->username);
			}
		}

		return $users;
	}

	public function userInfo($username)
	{
		$result = Model::getInstance()->query("SELECT * FROM users WHERE username = ? LIMIT 1", [$username]);

		if ($result->count()) {
			return $result->_results[0];
		}

		return false;
	}

	public function valueExist($table, $name, $value)
	{
		$result = Model::getInstance();
		$result->query("SELECT * FROM ? WHERE ? = ? LIMIT 1", [$table, $name, $value]);
		echo "Result->count: ";

		var_dump($result);

		if ($result->count()) {
			return true;
		} else {
			return false;
		}
	}

	public function registerUser($items = array())
	{
		$register = Model::getInstance();

		$register->insert('users', $items);
			
		if (!$register->error()) {
			return true;
		} else {
			return false;
		}
	}

	public function loginCheck($items = array())
	{
		$result = Model::getInstance()->query("SELECT * FROM users WHERE username = ? AND password = md5(? + salt))", [$items['username'], $items['password']]);

		if ($result->count() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>