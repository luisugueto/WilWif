<?php 

//include header template
require('layout/header.php'); 
?>
<?php 
if(isset($_GET['item_code']))
{
	$item = new item($_GET['item_code']);

	echo $item->item_code;
	echo '<br>';
	echo $item->item_name;
	echo '<br>';
	echo $item->item_description;
	echo '<br>';
	echo $item->item_address;
	echo '<br>';
	echo $item->item_title;
	echo '<br>';
	echo $item->item_type;
	echo '<br>';
	echo $item->item_user;
	echo '<br>';
	echo $item->item_photos_url[0];
	echo '<br>';
	echo $item->item_category_slug;
}
?>
<?php
//include header template
require('layout/footer.php');
?>