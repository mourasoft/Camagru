<?php
class Home extends Controller
{
	public  function __construct()
	{
	}
	public function index()
	{
		$data = [
			'flash' => getFlash(),
		];
		$this->view('index', $data);
	}
	public function about($id)
	{
		$data = [
			'flash' => getFlash(),
		];
		echo "$id that good";
		$this->view('about', $data);
	}
	public function like()
	{
		echo "like page is me";
	}
}
