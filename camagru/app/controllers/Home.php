<?php
class Home extends Controller{
    public  function __construct(){
    }
    public function index()
    {
        $data = [
            'title' => 'welcome',
        ];
        $this->view('index',$data);
    }
    public function about()
    {
        echo 'about page ';
    }
   
    
}