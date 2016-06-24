<?php 

//include header template
require('layout/header.php'); 

?>
<?php 
 if(isset($_POST['s']))
 {
	$sql = 'SELECT * FROM item';
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	?>
	<div>
	<?php
	while($row = mysql_fetch_assoc($query))
	{
		$item_category_id = $row["id_category"];
		$item_code = $row["code"];
		$item_name = $row["name"];
		$item_decription = $row["decription"];
		$item_title = $row["title"];
		$item_address = $row["findlost_address"];
		$item_type = $row["type"]; //lost   found
		$item_user_id = $row["id_user"];
		$item_photos_url;
		$item_user = "Omar Angelino";
		$item_category_slug ="Passport";
		?>
			<div class="search_item_container" style="height: 200px; background-image: url('../image/cuadro_inicia_732x152.png'); background-size: 102% 100%;">
					<div class="search_item_photo_container" style="float: left; width: 200px; background-image: url('../image/recuadro_imagen_125x132.png'); background-repeat: no-repeat; height: 200px; padding: 29px 0px 0px; background-size: 100% 100%;">
						<img src="/image/No_image_available_125x132.png" width="125" height="132" title="item photo">
					</div>
					<div class="search_item_information_container"  style="float: left; width: 80%;">
					    <div>
						 <h3><?php echo $item_title; ?></h3>
						</div>
						<div  style="height: 60px;">
						 
						</div>
						<div style="height: 71px;">
						   <div style="height: 70px; float: left; background-image: url('../image/barra_titulo_345x43.png'); background-size: 100% 100%; width: 232px; font-size: 20px; padding-top: 18px;margin-left: -35px;">
						      <h3	style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;"><?php echo $item_type;?></h3>
							   <h3 style="margin-top: 0px; margin-bottom: 0px; font-size: 14px; line-height: 14px;"><?php echo $item_user;?></h3>
						   </div>
						   <div  style="height: 26px; float: right; padding-top: 20px; border-right-width: 0px; margin-right: 30px;">
							  <form action="/item/" method="post">
								<input type="hidden"  name="item_code" value="<?php echo $item_code; ?>">
								<input type="submit" value="More Info" style="height: 33px; background-image: url('../image/boton_moreinfo_on_134x36.png'); background-size: 100% 100%; width: 100px; border-width: 0px; background-color: transparent;">
							  </form>	
						   </div>
						</div>
					</div>
			</div>
		<?php
	}
	?>
	</div>
	<?php
 }
?>
<?php
//include header template
require('layout/footer.php');
?>