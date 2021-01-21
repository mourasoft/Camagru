<?php
class Users extends controller
{
	public function __construct()
	{
		// load model
		$this->userModel = $this->model('User');;
	}

	public function register($id = null, $token = null)
	{
		// echo $id;
		// echo $token;
		// var_dump($this);
		// die();
		// check for POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//process form
			$data = [
				'username' => trim($_POST['username']),
				'email' => trim($_POST['email']),
				'password' => $_POST['password'],
				'c_password' => $_POST['c_password'],
				'username_err' => '',
				'c_password_err' => '',
				'password_err' => '',
				'email_err' => ''
			];
			// valid username
			if (empty($_POST['username'])) {
				$data['username_err'] = "Please enter your username.";
			} else {
				if (!preg_match('/^[0-9A-Za-z_]{4,25}$/', $_POST['username'])) {
					$data['username_err'] = "Please use only letters, numbers, underscore.";
				}
				// check username if was used

			}
			// valid email
			if (empty($_POST['email'])) {
				$data['email_err'] = "Please enter your email.";
			} else {
				if (!preg_match('/^([a-z._0-9-]+)@([a-z0-9]+[.]?)*([a-z0-9])(\.[a-z]{2,4})$/mi', $_POST['email']) && (strlen($_POST['email']) > 60)) {
					$data['email_err'] = "Please use valid email.";
				}
				// check email if was used
			}
			// valid password
			if (empty($_POST['password'])) {
				$data['password_err'] = "Please enter your password.";
			} else {
				if (!preg_match('/(?=.{8,32})(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/m', $_POST['password'])) {
					$data['password_err'] = "Please enter valid password.";
				}
			}
			// valid confirme password
			if (empty($_POST['c_password'])) {
				$data['c_password_err'] = "Please enter confirme password.";
			} else {
				if ($_POST['password'] != $_POST['c_password']) {
					$data['c_password_err'] = "Please confirme your password.";
				}
			}

			// check if all error are empty
			if (empty($data['username_err']) && empty($data['c_password_err']) && empty($data['password_err']) && empty($data['email_err'])) {
				// is valid process registration with model 
				header("Location:" . URLROOT . "/users/login");
			} else {
				// load the view with error
				$this->view('users/register', $data);
			}
		} else {
			// init data
			$data = [
				'username' => '',
				'email' => '',
				'password' => '',
				'c_password' => '',
				'username_err' => '',
				'c_password_err' => '',
				'password_err' => '',
				'email_err' => ''
			];
		}
		$this->view('/users/register', $data);
	}
	public function login()
	{
		$this->view('/users/login');
	}
}
