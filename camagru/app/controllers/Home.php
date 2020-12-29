<?php
class Home extends Controller{
    public  function __construct()
    {
        $this->postmodel = $this->model('Post');
    }
    public function index()
    {
        $this->view('index');
    }
    public function about()
    {
        echo 'about page ';
    }
   
    
}