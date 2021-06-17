<?php
class Home extends Controller
{
	public  function __construct()
	{
		$this->userCamera = $this->model('Studio');
	}
	public function index($pages = '')
	{
		$pages = isset($pages) ? (int)$pages  : 1;
		$perPage = 5;
		$allPost = $this->userCamera->countAllImage();
		$totalPage = ceil($allPost / $perPage);
		if ($pages > 1 && $pages <= $totalPage) {
			$start = ($pages * $perPage) - $perPage;
		} else {
			$start = 0;
		}

		$imgs = $this->userCamera->getAllImage($start, $perPage);
		$userID = isset($_SESSION['auth']->id) ? $_SESSION['auth']->id : null;
		$imgs = $this->userCamera->setData($imgs, $userID);
		$this->view('index', ['posts' => $imgs, 'all' => $totalPage]);
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
		$json = [];
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			redirect("/users/login");
		} else {
			if (isLogged()) {
				if (isset($_POST['img']) && isset($_POST['comment'])) {
					$comment = htmlentities($_POST['comment']);
					$img = $_POST['img'];
					$img_path = $_POST['img'];
					$id_user = $_SESSION['auth']->id;
					if ($this->userCamera->addComment($img_path, $comment, $id_user)) {
						$imgOwner = $this->userCamera->getNotif($img);
						if ($imgOwner->notif) {
							$json['notif'] = true;
							$json['email'] = $imgOwner->email;
						}
					} else {
						echo 'something went wrong';
					}
				}
			}
		}
		echo json_encode($json);
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
