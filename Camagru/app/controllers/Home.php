<?php
class Home extends Controller
{
	public  function __construct()
	{
		$this->userCamera = $this->model('Studio');
	}
	public function index()
	{
		$posts = $this->userCamera->getAllImage();
		$this->view('index', ['posts' => $posts]);
	}

	public function setLike()
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			redirect("/users/login");
		} else {
			$json = [];
			if (isLogged()) {
				if (isset($_POST['id'])) {
					$user = $_SESSION['auth']->id;
					$img = $_POST['id'];
					// check if alerdy liked 
					if ($this->userCamera->checkLike($user, $img)) {
						// remove like
						$json['liked'] = false;
						$this->userCamera->removeLike($user, $img);
					} else {
						// add like
						$this->userCamera->addLike($user, $img);
						$json['liked'] = true;
						$imgOwner = $this->userCamera->getNotif($img);
						if ($imgOwner->notif) {
							$json['notif'] = true;
							$json['email'] = $imgOwner->email;
						}
					}
					$json['status'] = true;
					$json["redirect"] = "/users/login";
				}
			} else {
				setFlash("danger", "please login to like a post.");
				// redirect('/users/login');
				$json["status"] = false;
				$json["redirect"] = "/users/login";
			}

			echo json_encode($json);
		}
	}
	public function setComment()
	{
		// start to sent comment to database
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			redirect("/users/login");
		} else {
			if (isLogged()) {
				if (isset($_POST['img']) && isset($_POST['comment'])) {
					$comment = htmlentities($_POST['comment']);
					$img_path = $_POST['img'];
					$id_user = $_SESSION['auth']->id;
					if ($this->userCamera->addComment($img_path, $comment, $id_user)) {
						echo "all is good";
					} else {
						echo 'something went wrong';
					}
				}
			}
		}
		// echo $json;
	}
	public function emailing()
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			redirect("/");
		} else {
			if (isLogged()) {
				if (isset($_POST['email']) && isset($_POST['action'])) {
					if ($_POST['action'] == 'like') {
						sendLike($_POST['email']);
					} elseif ($_POST['action'] == 'comment') {
						sendComment($_POST['email']);
					}
				}
			}
		}
	}

	
}
