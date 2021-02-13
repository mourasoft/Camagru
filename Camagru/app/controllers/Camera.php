<?php
class Camera extends Controller
{
	public function __construct()
	{
		$this->userCamera = $this->model('Studio');;
	}
	public function index()
	{
		$this->camera();
	}
	public function camera()
	{
		if (isLogged())
			$this->view('/studio/camera');
		else{
			setFlash("success", "logged in to use camera");
			redirect('/');
		}
	}

	public function saveImage()
	{
		if (isLogged()) {


			if (isset($_POST['imgBase64']) && isset($_POST['emoticon'])) {

				if (!file_exists('/var/www/html/img/pic')) {
					chmod('/var/www/html/img', 0777);
					mkdir('/var/www/html/img/pic', 0777);
					chmod('/var/www/html/img/pic', 0777);
				}
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$upload_dir = '/var/www/html/img/pic/';
				$img = $_POST['imgBase64'];
				$emo = '/var/www/html/img/stikers/' . $_POST['emoticon'] . '.png';
				$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$d = base64_decode($img);
				$file = $upload_dir . time() . '.png';
				list($width, $height) = getimagesize($emo);
				$newwidth = $width * 1.7;
				$newheight = ($height / $width) * $newwidth;
				$src = imagecreatefrompng($emo);
				$dest = imagecreatefromstring($d);
				imagecopyresampled($dest, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				imagepng($dest, $file, 0);
				// $dest = file_get_contents($file);;
				// $dest = ["imageString" => base64_encode($dest)];
				// echo json_encode($dest);
				 $data =[
				    'user_id'  => $_SESSION['auth']->id,
				    'path' => $file
				];var_dump($data['path']);
				if($this->userCamera->saveImage($data)){
					echo "ok sent to data ";
				}else
				    return false;	  
				    	
			}
		} else {
			setFlash("success", "logged in to use camera");
			redirect('/');
		}
	}
}
