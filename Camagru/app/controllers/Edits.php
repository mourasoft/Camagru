<?php
class Edits extends Controller
{
	public function __construct()
	{
		$this->userModel = $this->model('user');
	}
	public function index()
	{
		$this->profil();
	}
	public function pass()
	{
		if (isLogged()) {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = [
					'new_password' => $_POST['new_password'],
					'cn_password' => $_POST['cn_password'],
					'oldpassword' => $_POST['oldpassword'],
					'new_password_err' => '',
					'cn_password_err' => '',
					'old_password_err' => ''
				];
				// valid password
				
				if (empty($_POST['new_password'])) {
					$data['new_password_err'] = "Please enter your  new password.";
				} else {
					// if (!preg_match('/(?=.{8,32})(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/m', $_POST['password'])) {
					// 	$data['password_err'] = "Please enter valid password.";
					// }
				}

				// valid confirme password
				if (empty($_POST['cn_password'])) {
					$data['cn_password_err'] = "Please enter confirme password.";
				} else {
					if ($_POST['new_password'] != $_POST['cn_password']) $data['cn_password_err'] = "Please Confirme Your Password.";
				}
				// not empty password
				if (empty($data['oldpassword'])) {
					$data['old_password_err'] = 'Please Enter Your Old Password';
				} else {
					$hash = $_SESSION['auth']->password;

					if (!password_verify($data['oldpassword'], $hash)) {
						$data['old_password_err'] = 'wrong password';
					}
				}
				if (!empty($data['new_password_err'])) $data['cn_password_err'] = '';
				if (empty($data['new_password_err']) && empty($data['cn_password_err']) && empty($data['old_password_err'])) {
					// procces changing of password
					$data['password'] = password_hash($data['new_password'], PASSWORD_BCRYPT);
					$data['id'] = $_SESSION['auth']->id;
					$this->userModel->passUpdate($data);
					setFlash('success', 'password was change');
					redirect('/edits/profil');
				} else {
					$this->view('/edit/pass', $data);
				}
			} else {
				$data = [
					'new_password' => '',
					'cn_password' => '',
					'oldpassword' => '',
					'new_password_err' => '',
					'cn_password_err' => '',
					'old_password_err' => ''
				];
				$this->view('/edit/pass', $data);
			}
		}
		else
			redirect('/');
	}
	public function profil()
	{

		if (isLogged()) {

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = [
					'username' => $_POST['username'],
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'notif' => isset($_POST['notif']) ? 1 : 0,
					'username_err' => '',
					'email_err' => '',
					'password_err' => ''
				];
				printf($data['notif']);
				echo"ana hna";
				$id = $_SESSION['auth']->id;
				if (empty($_POST['username'])) {
					$data['username_err'] = "Please enter your username.";
				} else {
					if (!preg_match('/^[0-9A-Za-z_]{4,25}$/', $_POST['username'])) {
						$data['username_err'] = "Please use only letters, numbers, underscore.";
					}
					// check username if was used
					else {
						if ($this->userModel->checkUsername($data['username'], $id)) {

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
						if ($this->userModel->checkEmail($data['email'], $id)) {
							// echo "in condition";
							$data['email_err'] = "Email alerdy taken.";
						}
					}
				}
				// not empty password
				if (empty($data['password'])) {
					$data['password_err'] = 'Please Enter Your Password';
				} else {
					$hash = $_SESSION['auth']->password;
					if (!password_verify($data['password'], $hash)) {
						$data['password_err'] = 'wrong password';
					}
				}
				// checkbox 
				// if()
				if (empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err'])) {

					$data['username'] = strtolower($data['username']);
					$data['email'] = strtolower($data['email']);
					$this->userModel->updateprofil($id, $data);
					setFlash("success", "Your Profile was updat");
					$var = $this->userModel->getById($id);
					$_SESSION['auth'] = $var;
					redirect('/edits/profil');
				} else {

					$this->view('/edit/profil', $data);
				}
			} else
			
				$data = [
					'username' => $_SESSION['auth']->username,
					'email' => $_SESSION['auth']->email,
					'notif' => $_SESSION['auth']->notif,
					'password' => '',
					'username_err' => '',
					'email_err' => '',
					'password_err' => '',
				];
			$this->view('/edit/profil', $data);
		} else
			redirect('/');
	}
}
