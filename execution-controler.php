<?php 

if($path_urls[2])
{
 $path = $path_urls[2];
}else{
 $path = "";
}

switch ($path){
	case 'filecrop':
	   include 'includes/filecrop.php';
	break;
	case 'fileuploader':
	   include 'includes/fileuploader.php';
	break;
    case 'search_items':
	   include 'includes/search_items.php';
	break;
	default:
	 die("Access denied");
	break;
}
?>