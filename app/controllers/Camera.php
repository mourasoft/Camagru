<?php
class Camera extends Controller
{
    public function __construct()
    {
        $this->userCamera = $this->model('Studio');;
    }
    public function index(){
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
			$emo = $_POST['emoticon'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$d = base64_decode($img);
			$file = $upload_dir . time() . '.png';
			file_put_contents($file, $d);
			list($srcWidth, $srcHeight) = getimagesize($file);
			$src = imagecreatefrompng($emo);
			$dest = imagecreatefrompng($file);
			imagecopy($dest, $src, 11, 11, 0, 0, $srcWidth, $srcHeight);
			move_uploaded_file($dest, $file);
	

			 $data =[
			    'user_id'  => $_SESSION['auth']->id,
			    'path' => $file,
			];var_dump($data);
			// die();
			// if($this->postModel->save($data)){

			// }else
			//     return false;	  
			//     }	
		}
	}
    
}