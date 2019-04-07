<?php
if (!defined("SECURE")) exit("No direct script access allowed");

/*
*	Core Database functions (SUID)
*/

class Model
{
	private static $_instance = null;
	private	$_pdo, // DataBase Handler
			$_query,
			$_error = false,
			$_result,
			$_count = 0;


	private function __construct() {
		try {
			$this->_pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		}
		catch (PDOException $e)	{
    		echo $e->getMessage();
		}
	}

	public function __destruct() {
		$_pdo = null;
	}


	// No more than 1 instance of database (Singularity pattern)
	protected static function getInstance() {
		if (!isset(self::$_instance))
		{
			self::$_instance = new Model();
		}
		return self::$_instance;
	}


	// PDO query stuff
	protected function query($sql, $params = array()) {
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$pos = 1;
			if (count($params)) {
				foreach ($params as $param) {
					$this->_query->bindValue($pos, $param);
					$pos++;
				}
			}

			if ($this->_query->execute()) {
				
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}
			else {
				$this->_error = true;
			}
		}

		return $this;
	}

	protected function insert($table, $fields = array())
	{
		if (count($fields)) {
			$keys = array_keys($fields);
			$values = '';
			$x = 1;

			foreach ($fields as $field) {
				$values .= '?';

				if ($x < count($fields)) {
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`".implode('`, `', $keys)."`) VALUES ({$values})";

			if ($this->query($sql, $fields)->error()) {
				return true;
			}
		}

		return false;
	}


	// Return query results
	public function results()
	{
		return $this->_results;
	}

	// Return TRUE if there's an error in query (true/false)
	public function error()
	{
		return $this->_error;
	}

	// Return number of rows in results, starting from 1
	public function count()
	{
		return $this->_count;
	}
}

?>