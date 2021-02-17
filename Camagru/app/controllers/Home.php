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
		$json = [];
		if (isLogged()) {
			if (isset($_POST['id'])) {
				// check if alerdy liked 
				$user = $_SESSION['auth']->id;
				$img = $_POST['id'];
				if ($this->userCamera->checkLike($user, $img)) {
					// removeit
					$json['liked'] = false;
					$this->userCamera->removeLike($user, $img);
					// echo "removed";
				} else {
					$this->userCamera->addLike($user, $img);
					$json['liked'] = true;
					// echo "its aded";
				}
				$json['status'] = true;
				// $json["redirect"] = "/users/login";
			}
		} else {
			setFlash("danger", "please login to like a post.");
			// redirect('/users/login');
			$json["status"] = false;
			$json["redirect"] = "/users/login";
		}
		echo json_encode($json);
	}
	public function setComment()
	{
		// start to sent comment to database
		if (isLogged()) {
			if (isset($_POST['img']) && isset($_POST['comment'])) {
				$comment = htmlentities($_POST['comment']);
				$img_path = $_POST['img'];
				$id_user = $_SESSION['auth']->id;
				if($this->userCamera->addComment($img_path,$comment,$id_user)) {
					echo "all is good";
				} else {
					echo 'something went wrong';
				}

			}
		}
		// echo $json;
	}
}
