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

$item = new item($_GET['code']);
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
	<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
		<div style="width: 890px; height: 400px; display: inline-block; border-radius: 20px; overflow: auto; padding: 80px 70px; background-image: url('/image/cuadro-generico3-1014-487.png'); background-size: 100% 100%;color:white">
			<div style="float: left; padding: 30px; background-color: rgba(240, 240, 240, 0.8); border-radius: 10px; height: 240px;">
								<?php if($item->HasPhoto())
								{
									echo  '<img src="'.$item->item_photos_url[0].'" width="180" height="180" title="item photo" style="height: 180px; border-radius: 20px;">';	
								}else{
									echo '<img src="/image/No_image_available_125x132.png" width="180" height="180" title="item photo" style="height: 180px; border-radius: 20px;">';	
								}
								?>
			</div>
			<div style="float: left; width: 400px; height: 240px; padding-left: 10px; padding-right: 10px;">
				<div style="height: 40px; font-size: 30px;">
					Title
				</div>
				<div style="height: 60px;width: 400px;  background-image: url('/image/barra-generica1-479-66.png'); background-size: 100% auto; padding: 10px 25px 10px 10px; text-align: left; font-size: 13px; line-height: 20px;">
					<label style="display: inline-block; width: 150px; overflow: hidden;">Type: <?php echo $item->item_type; ?></label>
					<label style="display: inline-block; width: 150px; overflow: hidden;">Category: <?php echo $item->item_category_slug; ?></label>
					<label style="display: inline-block; width: 300px; overflow: hidden;">by <?php echo $item->item_user; ?></label>
				</div>
				<div style="height: 60px; width: 450px;">
					Description:<br>
					<?php echo $item->item_description; ?>
					
				</div>
				<div style="height: 80px; width: 450px;  background-image: url('/image/barra-generica1-479-66.png'); background-size: 100% auto; padding: 10px 25px 10px 10px; text-align: left; font-size: 13px; line-height: 20px;">
					<label style="display: inline-block; width: 300px; overflow: hidden;">Code: <?php echo $item->item_code; ?></label>
					<label style="display: inline-block; width: 150px; overflow: hidden;">Country: <?php echo $item->item_country; ?></label>
					<label style="display: inline-block; width: 150px; overflow: hidden;">City: <?php echo $item->item_city; ?></label>
					<label style="display: inline-block; width: 300px; overflow: hidden;">Address: <?php echo $item->item_address; ?></label>
					
				</div>
			</div>
		</div>
		
		<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">
		
			<div style="clear: both; content: ''; display: table; float: right;">
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a href='/account/'>";?>
						<img width="50" height="50" src="/image/boton-volver-50-50.png" style="cursor: pointer;">
						<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
					</a>
				</div>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a href='/account/found-item/'>";?>
						<img width="50" height="50" src="/image/boton-aceptar-39-39.png" style="cursor: pointer;">
						<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Request</p>
					</a>
				</div>
			</div>
		
		</div>
	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>