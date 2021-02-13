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
		$this->db->query('UPDATE `users` SET `confirmation_token` = NULL , `confirmed_at` = NOW() WHERE `id` = :id');
		$this->db->bind(':id', $id);
		$this->db->execute();
	}
	public function checklogin($login)
	{
		if ($this->checkUserexist($login))
			return true;
		else {
			if ($this->checkEmailexist($login))
				return true;
			else
				return false;
		}
	}
	public function getDataUser($data)
	{
		$this->db->query("SELECT * FROM `users` WHERE `username` = :login OR `email` = :login");
		$this->db->bind(':login', $data);
		return $this->db->single();
	}
	public function resetToken($email, $token)
	{
		$this->db->query("UPDATE `users` SET `reset_token` = :token , `reset_at` = NOW() WHERE `email` = :email");
		$this->db->bind(':email', $email);
		$this->db->bind(':token', $token);

		$this->db->execute();
	}
	public function reset_very($id)
	{
		$this->db->query('SELECT * FROM `users` WHERE `id` = :id AND reset_at > DATE_SUB(NOW(), INTERVAL 60 MINUTE)');
		$this->db->bind(':id', $id);
		return $this->db->single();
	}
	public function resetUpdate($id)
	{
		$this->db->query('UPDATE `users` SET `reset_token` = NULL , `reset_at` = NOW() WHERE `id` = :id');
		$this->db->bind(':id', $id);
		$this->db->execute();
	}
	public function passUpdate($data)
	{
		$this->db->query('UPDATE `users` SET `password` = :pass  WHERE `id` = :id');
		$this->db->bind(':id', $data['id']);
		$this->db->bind(':pass', $data['password']);
		$this->db->execute();
	}
	public function checkUsername($username,$id)
	{
		$this->db->query('SELECT * FROM `users` WHERE `username`=:username AND `id` <> :id');
		$this->db->bind(':username', $username);
		$this->db->bind(':id',$id);
		$this->db->single();
		$var = $this->db->rowCount();
		if ($var) {
			return true;
		} else
			return false;
	}
	public function checkEmail($email,$id)
	{
		$this->db->query('SELECT * FROM `users` WHERE `email`=:email AND `id` <> :id');
		$this->db->bind(':email', $email);
		$this->db->bind(':id', $id);
		$this->db->single();
		$var = $this->db->rowCount();
		if ($var) {
			return true;
		} else
			return false;
	}
	public function updateprofil($id,$data){
		$this->db->query('UPDATE `users` SET `username` = :username , `email` = :email WHERE `id` = :id');
		$this->db->bind(':id', $id);
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->execute();
	}
	public function getById($id)
	{
		$this->db->query("SELECT * FROM `users` WHERE `id` = :id");
		$this->db->bind(':id', $id);
		return $this->db->single();
	}
}
