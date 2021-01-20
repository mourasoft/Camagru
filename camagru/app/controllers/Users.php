<?php
class Users extends controller
{
	public function __construct()
	{
		// load model
	}

	public function register()
	{
		// check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
		} else {
			// init data
			$data = [
				'username' => '',
				'email'=>'',
				'password'=>'',
				'c_password'=>'',
				'username-err'=>'',
				'c_password_err'=>'',
				'password_err'=>'no pasword',
				'email_err'=>'is wrong'
			];
		}
		$this->view('/users/register',$data);
	}
	public function login()
	{
		$this->view('/users/login');
	}
}
