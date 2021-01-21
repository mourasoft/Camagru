<?php
class User
{
	private $db;
	public function __constract()
	{
		$this->db = new Database;
	}
	// check if email exist in database.
	// public function checkEMailExist($email)
	// {
	// $this->db->query();
	// }
	// check if username exist in database
	// public function checkUserexist($username)
	// {
	// }
}
