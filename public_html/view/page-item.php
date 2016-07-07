<?php 

//include header template
require('layout/header.php'); 
if($user->is_logged_in() ){
	if(isset($_POST['code']))
	{
		$code = $_POST['code'];
	}
	
	if (isset($_POST['submit'])) {
	 	$query_send = "UPDATE item SET status = 'Deleted' WHERE id = $code";
	 	$send = mysql_query($query_send);
	 	if($_POST['tipo']=='s')
	 	{
	 		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Send Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	 	}
	 	elseif($_POST['tipo']=='r')
	 	{
	 		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Receive Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	 	}
	}

	if(isset($_POST['send']))
	{

	}

}


?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form style="height: 0px; float: right;">
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="float: right; border-width: 0px; margin-top: 10px; background-image: url('	/image/barra-generica-478-47.png'); background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 70px; padding-left: 90px; width: 386px; height: 51px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
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

	if($user->is_logged_in() ){ 
		if($item->item_type == 'Found' && $item->item_status == 'Active'){
		?>
			<form action="/account/shipment" method="POST">
				<input type="hidden" name="code" id="code" value="<?php echo $item->item_id; ?>">
				<input type="hidden" name="tipo" id="tipo" value="s">
				<input onclick="return confirm('¿Send Item?')" class="btn btn-primary" type="submit" name="submit" id="submit" value="Send">
			</form>
		<?php
		}
		elseif ($item->item_type == 'Lost' && $item->item_status == 'Active') {
		?>
			<form action="/account/order" method="POST">
				<input type="hidden" name="code" id="code" value="<?php echo $item->item_id; ?>">
				<input type="hidden" name="tipo" id="tipo" value="r">
				<input onclick="return confirm('¿Receive Item?')" class="btn btn-primary" type="submit" name="submit" id="submit" value="Receive">
			</form>
		<?php
		}
	}
}
?>
<div style="height: 200px;">
	<div style="height: 100px;">
		<div style="float: left;">
		  <img src="<?php echo $item->item_photos_url[0]; ?>">
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

	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>