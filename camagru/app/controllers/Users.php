<?php
class Users extends controller
{
	public function __construct()
	{
		// load model
		$this->userModel = $this->model('User');
	}
	public function index()
	{
		redirect('/');
	}

	public function register()
	{
		if (islogged())
			redirect('/');

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
				else {

					if ($this->userModel->checkUserexist($data['username'])) {
						echo "in condition";
						$data['username_err'] = "Username alerdy taken.";
					}
				}
			}
			// valid email
			if (empty($_POST['email'])) {
				$data['email_err'] = "Please enter your email.";
			} else {
				if (!preg_match('/^([a-z._0-9-]+)@([a-z0-9]+[.]?)*([a-z0-9])(\.[a-z]{2,4})$/mi', $_POST['email'])) {
					$data['email_err'] = "Please use valid email.";
				}
				// check email if was used
				else {
					if ($this->userModel->checkEmailexist($data['email'])) {
						echo "in condition";
						$data['email_err'] = "Email alerdy taken.";
					}
				}
			}
			// valid password
			if (empty($_POST['password'])) {
				$data['password_err'] = "Please enter your password.";
			} else {
				// if (!preg_match('/(?=.{8,32})(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/m', $_POST['password'])) {
				// 	$data['password_err'] = "Please enter valid password.";
				// }
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
				// initial data 
				$data['username'] = strtolower($data['username']);
				$data['email'] = strtolower($data['email']);
				$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
				$token = gen_token(40);

				if ($this->userModel->register($data, $token)) {
					$id = $this->userModel->lastId();
					send_token($data, $token, $id);
					setFlash("success", "account successfully created check your email.");
					redirect('/users/login');
				} else {
					die('registration error');
				}
			} else {
				// load the view with error
				$this->view('/users/register', $data);
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

			$this->view('/users/register', $data);
		}
	}
	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = [
				'login' => $_POST['login'],
				'password' => $_POST['password'],
				'login_err' => '',
				'password_err' => '',
			];
			// valid login
			if (empty($data['login']) or empty($data['password'])) {
				if (empty($data['login'])) $data['login_err'] = 'Email or username is required';
				if (empty($data['password'])) $data['password_err'] = 'password is required';
			} else {
				if (!($this->userModel->checklogin($data['login']))) {
					/* login not found */
					$data['login_err'] = 'login or password is not good';
				} else {
					/*check the password*/
					$var = $this->userModel->getDataUser($data['login']);
					if (!password_verify($data['password'], ($var->password))) {
						$data['password_err'] = 'wrong password';
					}
				}
			}
			if (isset($data['login_err'])) $data['password'] = '';
			if (empty($data['password_err']) && empty($data['login_err'])) {
				$var = $this->userModel->getDataUser($data['login']);
				if (!$var->confirmed_at) {
					setFlash('danger', 'please verify your account email');
					redirect('/users/login');
					debug($var->confirmed_at);
				} else {
					// echo "is confirmed"; creat a session to a user 
					$_SESSION['auth'] = $var;
					// var_dump($_SESSION['auth']);
					$user = $_SESSION['auth'];
					// echo $user->username;
					// die();
					redirect('/');
				}
			} else {
				$this->view('/users/login', $data);
			}
		} else {
			$data = [
				'login' => '',
				'password' => '',
				'login_err' => '',
				'password_err' => '',
			];
			$this->view('/users/login', $data);
		}
	}
	public function verify($id = '', $token = '')
	{
		// session_start();
		if (is_numeric($id) && (strlen($token) == 40)) {
			$token_very = $this->userModel->token_very($id);
			if ($token_very == $token) {
				$this->userModel->tokenUpdate($id);
				setFlash("success", "safi dakchi nadi");
				redirect("/users/login");
			} else {
				setFlash("danger", "token alerdy checked");
				redirect("/users/login");
			}
		} else {

			setFlash("danger", "token not valid");
			redirect("/users/register");
		}
	}
	public function logout(){
		unset($_SESSION['auth']);
		redirect('/users/login');
	}
}
