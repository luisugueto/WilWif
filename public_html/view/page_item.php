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
<div style="height: 200px;">
	<div style="height: 100px;">
		<div style="float: left;">
		  <img src="<?php echo "/".$item->item_photos_url[0]; ?>">
		</div>
		<div style="float: left;">
			<div style="height: 30px;"> tittle object </div>
			<div style="height: 68px;"> Descripcion </div>
		</div>
	</div>
	<div>
	  Found By ...
	</div>
	<div>
	  Category : .....
	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>