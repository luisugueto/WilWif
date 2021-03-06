<?php 
require('../includes/config.php');
require('../classes/db.php');
require('../classes/item.php');
require('../classes/functions.php');
require('../classes/userInfo.php');
require('../classes/shipment.php');
require('../classes/errorCode.php');
require('../classes/order.php');
require('../classes/configuration.php');
require_once('../lib/phpmailer/phpmailer.php');
$configuration = new configuration();
$debug =true;
$GLOBALS['configuration'] = $configuration;
/* configuration example 
	$GLOBALS['configuration']->getOption('domain');
	$GLOBALS['configuration']->getOption('email');
	$GLOBALS['configuration']->getOption('nresult');
	$GLOBALS['configuration']->getOption('maxattemps');
	$GLOBALS['configuration']->getOption('domainadmin');
*/

//SendMail( $to,$subject, $message) 
//CreateNotification(id_user,$message))
if(!$debug)
{
	error_reporting(0);
}


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
	case 'account':
	   include 'view/page-account.php';
		break;
	case 'changepassword':
	   include 'view/page-change-password.php';
		break;
	case 'execution':
	   include '../execution-controler.php';
		break;
	case 'employees':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'employee':
				include 'view/page-employee.php';	
				break;
			case 'viewemployee':
				include 'view/page-view-employee.php';	
				break;
			default:
				include 'view/page-employees.php';
				break;
		}
		break;
	
	case 'users':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'user':
				include 'view/page-user.php';	
				break;
			case 'edit':
				include 'view/page-user-edit.php';	
				break;
			case 'block':
				include 'view/page-user-block.php';	
				break;
			case 'unlock':
				include 'view/page-user-unlock.php';	
				break;
			
			default:
				include 'view/page-users.php';
				break;
		}
		break;

	case 'items':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'found':
				if(isset($path_urls[3]))
				{
				 $third_path = $path_urls[3];
				}else{
				 $third_path = "";
				}
				switch ($third_path){
					case 'item':
						include 'view/page-found-item.php';	
						break;
					default:
						include 'view/page-found-items.php';
						break;
				}
				break;
			
			case 'lost':
				if(isset($path_urls[3]))
				{
				 $third_path = $path_urls[3];
				}else{
				 $third_path = "";
				}
				switch ($third_path){
					case 'item':
						include 'view/page-lost-item.php';	
						break;
					default:
						include 'view/page-lost-items.php';
						break;
				}
				
				break;
			
			default:
				include 'view/page-items.php';
				break;
		}
		break;
	
	case 'orders':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'order':
				include 'view/page-order.php';	
				break;
			
			default:
				include 'view/page-orders.php';
				break;
		}
		break;
	
	case 'shipments':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'shipment':
				include 'view/page-shipment.php';	
				break;
			
			default:
				include 'view/page-shipments.php';
				break;
		}
		break;
	
	case 'notifications':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'notification':
				include 'view/page-notification.php';	
				break;
			
			default:
				include 'view/page-notifications.php';
				break;
		}
		break;
	
	case 'records':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'record':
				include 'view/page-record.php';	
				break;
			
			default:
				include 'view/page-records.php';
				break;
		}
		break;
	
	case 'chats':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){
			case 'view':
				include 'view/page-chat-view.php';	
				break;
				
			case 'chat':
				include 'view/page-chat-chat.php';	
				break;
			
			case 'chats':
				include 'view/page-chats-chats.php';	
				break;
			
			case 'users':
				include 'view/page-chat-users.php';	
				break;
			
			default:
				include 'view/page-chats.php';
				break;
		}
		break;
	
	case 'configurations':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			
			default:
				include 'view/page-configurations.php';
				break;
		}
		break;
	
	case 'statistics':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			
			default:
				include 'view/page-statistics.php';
				break;
		}
		break;
		
	case 'reset':
			include 'view/page-reset.php';
		break;
	case 'logout':
			session_destroy();
			header('Location: /');
		break;
		
	default:
		if($user->is_logged_in())
		{
			include 'view/page-home.php';
		}else{
			include 'view/page-login.php';
		}
		break;
	
}

