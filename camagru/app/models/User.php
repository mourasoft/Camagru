<?php
class User
{
	private $db;
	public function __construct()
	{
		$this->db = new Database;
	}

	public function checkUserexist($username)
	{
		$this->db->query('SELECT * FROM `users` WHERE `username`=:username');
		$this->db->bind(':username', $username);
		$this->db->single();
		$var = $this->db->rowCount();
		if ($var) {
			return true;
		} else
			return false;
	}
	public function checkEmailexist($email)
	{
		$this->db->query('SELECT * FROM `users` WHERE `email`=:email');
		$this->db->bind(':email', $email);
		$this->db->single();
		$var = $this->db->rowCount();
		if ($var) {
			return true;
		} else
			return false;
	}
	public function register($data, $token)
	{
		$this->db->query("INSERT INTO `users` SET `username`= :username, `email` = :email , `password` = :password, `confirmation_token` = :token ");
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':token', $token);
		return $this->db->execute();;
	}
	public function lastId()
	{
		return $this->db->lastInsertId();
	}
	public function token_very($id)
	{
		$this->db->query('SELECT `confirmation_token` FROM `users` WHERE `id` = :id');
		$this->db->bind(':id', $id);
		return $this->db->single()->confirmation_token;
	}
	public function tokenUpdate($id)
	{
		$this->db->query('UPDATE `users` SET `confirmation_token` = NULL , `confirmed_at` = NOW()');
		$this->db->execute();
	}
	public function checklogin($login)
	{
		if($this->checkUserexist($login))
			return true;
		else{
			if($this->checkEmailexist($login))
				return true;
			else
				return false;
		}
	}
	public function getDataUser($data){
		$this->db->query("SELECT * FROM `users` WHERE `username` = :login OR `email` = :login");
		$this->db->bind(':login', $data);
		return $this->db->single();
	}
}
