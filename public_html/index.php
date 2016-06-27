<?php 
require('../includes/config.php');
require('../classes/db.php');
$db = new DB();
//define page title
$title = 'Lost Object';
$request_url = $_SERVER['REQUEST_URI'];
$path_urls = explode('/', $request_url); 
/*here we define the path request will take*/
if($path_urls[1])
{
 $path = $path_urls[1];
}else{
 $path = "";
}
 $path = $path_urls[1];

switch ($path){
    case '1':
	
	break;
	
	case 'login':
	  include 'view/page-login.php';
	break;
	
	case 'register':
	 include 'view/page_register.php';
	break;
	
	case 'nuevoItem':
	 include 'view/page-newItem.php';
	break;

	case 'logout':
	 session_destroy();
	 header('Location: /');
	break;
	
	default:
	 include 'view/page_home.php';
	break;
}

