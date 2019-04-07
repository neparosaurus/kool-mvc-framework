<?php
if (!defined("SECURE")) exit("No direct script access allowed");

//
// Core Controller functions
//

class Validation
{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct()
	{
		// $this->_db = Model::getInstance();
	}

	public function check($source, $items = array())
	{
		foreach ($items as $item => $rules) {
			$value = trim($source[$item]);

			foreach ($rules as $rule => $rule_value) {
				if ($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} elseif (!empty($value)) {
					switch($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters");
							}
							break;
						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters");
							}
							break;
						case 'matches':
							if ($value !== $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}");
							}
							break;
						case 'unique':
							$user = new m_user();
							$check = false;

							if ($rule_value === 'users') {
								$check = $user->userExist($value);
							}
							
							if ($check) {
								$this->addError("{$value} already exists");
							}
							break;
						case 'charset':
							if (!isSafe($value, $rule_value) && !empty($value)) {
								$this->addError("Illegal characters at {$item}");
							}
							break;
					}
				}
			}
		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}


	private function addError($error)
	{
		$this->_errors[] = $error;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function passed()
	{
		return $this->_passed;
	}
}