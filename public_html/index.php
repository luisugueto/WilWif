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
$db = new DB();
$configuration = new configuration();
$debug =true;
$GLOBALS['configuration'] = $configuration;
//define page title
$title = 'WilWif | Keep it Safe';
$request_url = $_SERVER['REQUEST_URI'];
$path_urls = explode('/', $request_url); 
/*here we define the path request will take*/
if($user->is_logged_in() ){
	
	UserAction();
}

if($path_urls[1])
{
 $path = $path_urls[1];
}else{
 $path = "";
}
$pagelocation="";
switch ($path){
	case 'share':
	   include 'view/page-share.php';
		break;
	case 'insurace':
	   include 'view/page-insurace.php';
		break;
	case 'code-received':
	   include 'view/page-code-received.php';
		break;
	case 'found-something':
	   include 'view/page-found-something.php';
		break;
	case 'register-choice':
	   include 'view/page-register-choice.php';
		break;
	case 'item':
	   include 'view/page-item.php';
		break;
		
	case 'itemnews':
	   include 'view/page-new-item.php';
		break;
		
	case 'login':
	  include 'view/page-login.php';
		break;
	
	case 'register':
	 include 'view/page-register.php';
		break;
	
	case 'reset':
	 include 'view/page-user-recovery-password.php';
		break;

	case 'account':
		if(isset($path_urls[2]))
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){
			case 'profile':
				include'view/page-user-information.php';
				break;
			
			case 'found-item':
				include'view/page-user-found-item.php';
				break;
				
			case 'found-category':
				include'view/page-user-found-category.php';
				break;
				
			case 'found-items':
				include'view/page-user-found-items.php';
				break;
			
			case 'lost-category':
				include'view/page-user-lost-category.php';
				break;
				
			case 'lost-item':
				include'view/page-user-lost-item.php';
				break;
				
			case 'lost-items':
				include'view/page-user-lost-items.php';
				break;
			
			case 'shipment':
				include'view/page-user-shipment.php';
				break;
			
			case 'shipments':
				include'view/page-user-shipments.php';
				break;

			case 'list-shipments':
				include'view/page-list-user-shipment.php';
				break;
				
			case 'order':
				include'view/page-user-order.php';
				break;
			
			case 'orders':
				include'view/page-user-orders.php';
				break;
			case 'list-orders':
				include'view/page-list-user-order.php';
				break;
			
			case 'request':
				include'view/page-user-request.php';
				break;
			
			case 'requests':
				include'view/page-user-requests.php';
				break;
			
			case 'notification':
				include'view/page-user-notification.php';
				break;
			
			case 'notifications':
				include'view/page-user-notifications.php';
				break;

			case 'notifications':
				include'view/page-user-notifications.php';
				break;

			case 'recoveryPassword':
				include'view/page-user-recovery-password.php';
				break;
			
			case 'help':
				include'view/page-user-help.php';
				break;
				
			default:
				include 'view/page-account.php';
				break;
		}
		
	break;
	
	case 'execution':
	   include '../execution-controler.php';
		break;
	
	case 'logout':
		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Logout', NOW())";
		$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
		session_destroy();
		header('Location: /');
		break;
		
	case 'search':
		include 'view/page-home.php';
		break;
		
	default:
		if($user->is_logged_in()){ 
			header('Location: /account/'); 
		}else{
			include 'view/home.php';//include 'view/page-login.php';
		}
		
		break;
}

