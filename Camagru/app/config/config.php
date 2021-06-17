 <?php
	//App root
	define('APPROOT', dirname(dirname(__FILE__)));
	//URL root
	define('URLROOT', $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER['HTTP_HOST']);
	//Site name 
	define('SITENAME', 'Camagru');
	//  DB 
	define('DB_HOST', 'db');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'Camagru');
