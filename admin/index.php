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
	case 'employees':
		if($path_urls[2])
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'employee':
				include 'view/page-employee.php';	
				break;
			
			default:
				include 'view/page-employees.php';
				break;
		}
		break;
	
	case 'users':
		if($path_urls[2])
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'user':
				include 'view/page-user.php';	
				break;
			
			default:
				include 'view/page-users.php';
				break;
		}
		break;

	case 'items':
		if($path_urls[2])
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'found':
				if($path_urls[3])
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
				if($path_urls[3])
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
		if($path_urls[2])
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
		if($path_urls[2])
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
		if($path_urls[2])
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
		if($path_urls[2])
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
		if($path_urls[2])
		{
		 $secundary_path = $path_urls[2];
		}else{
		 $secundary_path = "";
		}
		switch ($secundary_path){	
			case 'chats':
				include 'view/page-chat.php';	
				break;
			
			case 'chats':
				include 'view/page-chats.php';	
				break;
			
			default:
				include 'view/page-chat-users.php';
				break;
		}
		break;
	
	case 'configurations':
		if($path_urls[2])
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
		if($path_urls[2])
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
		
	default:
		if($user->is_logged_in() )
		{
			include 'view/page-home.php';
		}else{
			include 'view/page-login.php';
		}
		break;
	
}

