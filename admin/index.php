<?php 
require('../includes/config.php');
require('../classes/db.php');
require('../classes/item.php');
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


switch ($path){	
	case 'nuevoEmpleado':
		include 'view/page_register.php';
	break;
	case 'listadoUsuarios':
		include 'view/page_listadoUsuarios.php';
	break;
	case 'bloquearUsuario':
		include 'view/page-bloquearUsuario.php';
	break;
	case 'desbloquearUsuario':
		include 'view/page-DesbloquearUsuario.php';
	break;
	case 'modificarUsuario':
		include 'view/page-modificarUsuario.php';
	break;
	case 'articlesUsuario':
		include 'view/page_articlesUsuarios.php';
	break;
	case 'historyUsuario':
		include 'view/page_historyUsuario.php';
	break;
	case 'logout':
		session_destroy();
		header('Location: /');
	break;

	default:
	 	include 'view/page-login.php';
	break;
}

