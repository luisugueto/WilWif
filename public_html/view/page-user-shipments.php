<?php
require('layout/header.php');
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;padding-right: 81px; padding-left: 221px;">
		<div style="background-image: url('/image/barra-account-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;">Shipments</h1>
		</div>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	<div style="width: 890px; height: 508px; display: inline-block; background-color: rgba(240, 240, 240, 0.5); border-radius: 20px;overflow: auto;padding-top: 20px; padding-bottom: 20px;">
		
		<div class="rows" style=" display: block;">
			<?php
				$query = "SELECT code FROM `submit` WHERE id_user_send = ".$_SESSION['id']."  AND status != 'Erased'";
				$sql = mysql_query($query);
				$sql_row = mysql_num_rows($sql);
				if($sql_row == 0)
				{
					echo "<tr>
					<td colspan='4'>No data to display.</td>
					</tr>";
				}
				while($sql_assoc = mysql_fetch_assoc($sql))
				{
					$shipment = new shipment($sql_assoc['code']);
			?>
				<div class="item-row"  >
					<div style=" display: inline-block;">
						<div style="clear: both; content: ''; display: table; background-color: transparent; width: 750px; background-image: url('/image/cuadro_generico1_786x144.png'); height: 157px; border-radius: 20px; background-size: 110% 110%; color: white; padding: 10px;">
							<div style="float: left;">
								<?php if($shipment->shipment_item->HasPhoto())
								{
									echo  '<img src="'.$shipment->shipment_item->item_photos_url[0].'" width="125" height="132" title="item photo">';	
								}else{
									echo '<img src="/image/No_image_available_125x132.png" width="125" height="132" title="item photo">';	
								}
								?>
							</div>
							<div style="float: left; width: 400px; height: 137px; padding-left: 10px; padding-right: 10px;">
								<div style="height: 50px; font-size: 30px;">
									<?php echo $shipment->shipment_title; ?>
								</div>
								<div style="height: 82px; background-image: url('/image/barra-generica1-479-66.png'); background-size: 100% auto; padding: 10px 25px 10px 10px; text-align: left; font-size: 13px; line-height: 20px;">
									<div>
										<label style="display: inline-block; width: 300px; overflow: hidden;">Code: <?php echo $shipment->shipment_code; ?></label>
									</div>
									<div>
										<label style="display: inline-block; width: 150px; overflow: hidden;">Status: <?php echo $shipment->shipment_status; ?></label>
										<label style="display: inline-block; width: 150px; overflow: hidden;">Date: <?php echo $shipment->shipment_create_date; ?></label>
									</div>
									<div>
										
										<label style="display: inline-block; width: 300px; overflow: hidden;">Address: <?php echo $shipment->shipment_address; ?></label>
									</div>
									
								</div>
							</div>
							<div style="float: left; height: 137px; width: 100px;  padding-top: 20px;">
								<?php echo "<a href='/account/shipment/?code=".$shipment->shipment_code."'>";?>
									<img width="81" height="81" src="/image/boton-ver-81-81.png" style="cursor: pointer;">
								</a>
								<?php echo "<a href='/account/shipment/?code=".$shipment->shipment_code."'>";?>
									<p style="margin-top: 0px;">View</p>
								</a>
							</div>
							
						</div>
					</div>
				</div>		
			<?php	 
				}
			?>
		</div>
	</div>
	<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">
		
			<div style="clear: both; content: ''; display: table; float: right;">
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a href='/account/'>";?>
						<img width="50" height="50" src="/image/boton-volver-50-50.png" style="cursor: pointer;">
						<p style="width: 62px;margin-bottom: 0px;">Return</p>
					</a>
				</div>
			</div>
		
	</div>
</div>
</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>