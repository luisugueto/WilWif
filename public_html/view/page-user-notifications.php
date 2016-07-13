<?php
require('layout/header.php');

if (isset($_POST['deleted'])) {
	$query = mysql_query("UPDATE notifications SET status = 'Deleted' WHERE id_user = '".$_SESSION['id']."' ");
	header("Location: /account/notifications");
}
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;padding-right: 81px; padding-left: 221px;">
		<div style="background-image: url('/image/barra-account-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;">Notifications</h1>
		</div>
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	<div style="width: 890px; height: 508px; display: inline-block; background-color: rgba(240, 240, 240, 0.5); border-radius: 20px;overflow: auto;padding-top: 20px; padding-bottom: 20px;">
		
		<div class="rows" style=" display: block;">
			<?php
				$query = "SELECT * FROM notifications WHERE id_user = '".$_SESSION['id']."' AND status != 'Deleted' ";
				$sql = mysql_query($query);
				$sql_row = mysql_num_rows($sql);
				if($sql_row == 0)
				{
					echo "<tr>
					<td colspan='4'>No have.</td>
					</tr>";
				}
				
				while($sql_assoc = mysql_fetch_assoc($sql))
				{
			?>
				<div class="item-row"  >
					<div style=" display: inline-block;">
						<div style="clear: both; content: ''; display: table; background-color: transparent; width: 750px; background-image: url('/image/cuadro_generico1_786x144.png'); height: 157px; border-radius: 20px; background-size: 110% 110%; color: white; padding: 10px;">
							<div style="float: left; width: 400px; height: 100px; padding-left: 10px; padding-right: 10px; margin-top: 20px">
								
								<div style="height: 82px; background-image: url('/image/barra-generica1-479-66.png'); background-size: 100% auto; padding: 10px 25px 10px 10px; text-align: left; font-size: 13px; line-height: 20px;">
									<div>
										<label style="display: inline-block; width: 300px; overflow: hidden;">Message: <?php echo $sql_assoc['message'] ?></label>
									</div>
									<div>
										<label style="display: inline-block; width: 150px; overflow: hidden;">Date: <?php echo $sql_assoc['create_date'] ?></label>
										<label style="display: inline-block; width: 150px; overflow: hidden;">Status: <?php echo $sql_assoc['status']; ?></label>
									</div>
									
								</div>
							</div>
							<div style="float: right; height: 137px; width: 100px; padding-top: 40px;">
							<form action="" method="post">
							<input type="hidden" value="<?php echo $sql_assoc['id']; ?>" id="" name="deleted">
								<div class="row" style="margin-top: 0px">
									<div class="col-xs-6 col-md-6">
										<button type="submit" id="add" name="deleted" value="" style="background:url('/image/boton-eliminar1-34-34.png'); background-size: 100%; background-repeat: no-repeat; width: 50px; height: 50px; border: 0px">
										<p style="margin-top: 50px; color:white;">Trash</p>
										</button>
									</div>
							</form>
							</div>
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