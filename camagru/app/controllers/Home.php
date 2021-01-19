<?php
class Home extends Controller{
    public  function __construct(){
    }
    public function index()
    {
        $this->view('index',$data);
        
        $this->view('index');
    }
    public function about($id){
        
        echo "$id that good";
        $this->view('about');
    } 
    public function like(){
        echo "like page is me";
    }
}