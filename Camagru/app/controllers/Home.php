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
		$this->view('index', ['posts'=>$posts]);
	}

	public function setLike(){
		if(isset($_POST['id'])){
			
		}
	}
	

}
