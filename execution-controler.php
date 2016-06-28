<?php 

if($path_urls[2])
{
 $path = $path_urls[2];
}else{
 $path = "";
}

switch ($path){
    case 'search_items':
	   include 'includes/search_items.php';
	break;
	default:
	 die("Access denied");
	break;
}
?>