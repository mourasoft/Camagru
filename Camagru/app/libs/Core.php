<?php
/*
 * App core Class 
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];
   

   public function __construct(){
      
      $url = $this->getUrl();
	  // check in controllers for the first value
	  $var = isset($url[0]) ? $url[0] : '';
      if(file_exists('./app/controllers/'.ucwords($var).'.php'))
      {
         //    if exists set as controller
         $this->controller = ucwords($url[0]);
         // unset the url
		 unset($url[0]);
		 require_once './app/controllers/' . $this->controller . '.php'; 
	   }
       else if(!empty($url[0]))
       // here must redirected to the not found page Controller
       $this->controller = 'Not';
      // Look for the Method 
       if(isset($url[1])){
          if(method_exists($this->controller, $url[1]))
          {
             if ($url[1] == '__construct'){
               $this->controller = 'Not';
             }
             $this->method = $url[1];
          }
          else  //if method not exict go to the not found page
          { 
            $this->controller = 'Not'; 
            
            
          }
       } 
       unset($url[1]);
      //params part

      $this->param = $url ? array_values($url) : [];

      require_once './app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller; 
      call_user_func_array([$this->controller, $this->method], $this->param);

    }

       public function getUrl(){
       if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');//remove the last /
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url); //Split a string by a /
        return $url;
       }
    }
   
}
