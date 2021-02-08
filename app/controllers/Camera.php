<?php
class Camera extends Controller
{
	public function __construct()
	{
		$this->userCamera = $this->model('Studio');;
	}
	public function index()
	{
		$this->view('/studio/camera');
	}
	public function camera()
	{
		$this->view('/studio/camera');
	}

	public function saveImage()
	{


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
			// file_put_contents($file, $d);
			// list($srcWidth, $srcHeight) = getimagesize($emo);
			// // echo $emo;
			// $src = imagecreatefrompng($emo);
			// var_dump($src);
			// $dest = imagecreatefrompng($file);
			// var_dump($dest);
			// imagecopy($dest, $src, 37, 50, 0, 0, $srcWidth, $srcHeight);
			list($width,$height)=getimagesize($emo);
			$newwidth=150;
			$newheight=($height/$width)*$newwidth;
			$src = imagecreatefrompng($emo);
			$dest = imagecreatefromstring($d);
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagepng($dest, $file, 0);
			// imagepng($dest, $file, 9);
			// var_dump($dest);
			die("rani sekrana");
			// if (move_uploaded_file($dest, $upload_dir . "tach" . 'png'))
			// 	echo "ana sekrana";
			// else
			// 	echo "chada conge";



			//  $data =[
			//     'user_id'  => $_SESSION['auth']->id,
			//     'path' => $file,
			// ];var_dump($data);
			// die();
			// if($this->postModel->save($data)){

			// }else
			//     return false;	  
			//     }	
		}
	}
}
