<?php 

if($path_urls[2])
{
 $path = $path_urls[2];
}else{
 $path = "";
}

switch ($path){
	case 'read_notification':
	   include 'includes/read-notification.php';
	break;
	case 'filecrop':
	   include 'includes/filecrop.php';
	break;
	case 'fileuploader':
	   include 'includes/fileuploader.php';
	break;
    case 'search_items':
	   include 'includes/search_items.php';
	break;
	 case 'zuaruchat':
	   include 'includes/zuaruchat.php';
	break;
	case 'report':
	   include 'includes/createreport.php';
	break;
	default:
	 die("Access denied");
	break;
}
?>