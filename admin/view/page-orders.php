<?php
require('layout/header.php');

$sql = "SELECT * FROM `order`";
$query = mysql_query($sql) or die(mysql_error());

######### PAGINACIONN ###############
$nregistros = 4;
$nfilas = mysql_num_rows($query);
$numpags = $nfilas / $nregistros;
if (isset($_POST['pagina']))	$npagina = $_POST['pagina']; else $npagina = 1;

$sql .= " LIMIT ".((($npagina*$nregistros)-($nregistros-1))-1).", ".$nregistros;
$resultado = mysql_query($sql);
$rows = mysql_num_rows($resultado);

############################################

$type = 'p';
$id = isset($_POST['id']) ? $_POST['id'] : '';
$num_busqueda = 0;

if (isset($_POST['view'])) {
	$type = 'v';
	$sql_view = "SELECT * FROM `order` WHERE id = '".$id."'";
	$query_view = mysql_query($sql_view);
	$assoc_view = mysql_fetch_assoc($query_view);
}
elseif(isset($_POST['block'])){
	$sql_block = "UPDATE `order` SET status = 'Block' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
}
elseif(isset($_POST['unlock'])){
	$sql_block = "UPDATE `order` SET status = 'Unlock' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
}

elseif (isset($_POST['s'])) {
	$s = $_POST['s'];
	$sql_busqueda = "SELECT * FROM `order` WHERE message LIKE '$s%' || title LIKE '$s%' ";
	$query_busqueda = mysql_query($sql_busqueda);
	$assoc_busqueda = mysql_fetch_assoc($query_busqueda);
	$num_busqueda = mysql_num_rows($query_busqueda);
}
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-envios-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 270px; font-family: arial,rial;">SHIPMENTS</h1>
		</div>
		<form method="post" action="" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div style="margin-top: 30px; width: 1176px; height: 600px; display: inline-block; background-color: rgba(096,111,140,0.3);">
	
	<div id="content_containter" style="margin-top: 40px; margin-left: -120px; margin-bottom: 50px; width: 1440px; display: inline-block;">
		
		<div style="border-radius: 50px; margin-left: 170px;">
				<?php if ($type == 'p') { ?>

			<table style="border-collapse: collapse; border-color: white; width: 1000px; display: inline-block; background-color: rgba(096,111,140,0.3); " border="4px">
				<thead style="border: 5px;">
					<tr style="border: 5px solid; border-color: white;">
						<td width="400px" style="border: 5px solid; border-color: white;"><p style="color: white">Item Code</p></td>
						<td width="300px" style="border: 5px solid; border-color: white;"><p style="color: white">Message</p></td>
						<td width="300px" style="border: 5px solid; border-color: white;"><p style="color: white">Status</p></td>
						<td width="300px" style="border: 5px solid; border-color: white;"><p style="color: white">User Send</p></td>
						<td width="300px" style="border: 5px solid; border-color: white;"><p style="color: white">User Recived</p></td>
						<td width="300px" style="border: 5px solid; border-color: white;"><p style="color: white">Address</p></td>
						<td width="500px" style="border: 5px solid; border-color: white;"><p style="color: white">Options</p></td>
					</tr>
				</thead>
					<?php
							$sql_row = mysql_num_rows($resultado);
							if($sql_row == 0)
							{
								echo "<tr>
										<td colspan='7'><p style='color: white;'>No exist.</td>
									</tr>";
									die();
							}
							elseif ($num_busqueda == 0 && isset($_POST['s'])) {
								echo "<tr>
										<td colspan='7'><p style='color: white;'>No exist.</p></td>
									</tr>";
									die();
							}
							elseif($num_busqueda != 0)
							{
								while($assoc_busqueda = mysql_fetch_assoc($query_busqueda)){

							?>
								<tbody style="border: 5px solid; border-color: white;">
									<tr>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['code']; ?></td>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['message']; ?></td>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['status']; ?></td>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['id_user_send']; ?></td>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['id_user_recived']; ?></td>
										<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $assoc_busqueda['address']; ?></td>
										<td>
											<form action="" method="POST">
												<input type="hidden" value="<?php echo $sql_assoc['id'] ?>" id="id" name="id">
												<input class="btn btn-primary" type="submit" id="view" name="view" value="View">
												<input class="btn btn-danger" onclick="return confirm('¿Block Send?');" type="submit" id="block" name="block" value="Block">
												<input class="btn btn-secundary" onclick="return confirm('¿Unlock Send?');" type="submit" id="unlock" name="unlock" value="Unlock">
											</form>
										</td>
								</tbody>
							<?php
								}
							die();
							}
							while($sql_assoc = mysql_fetch_assoc($resultado)){
					?>
					<tbody style="border: 5px solid; border-color: white;">
						<tr>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['code']; ?></td>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['message']; ?></td>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['status']; ?></td>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['id_user_send']; ?></td>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['id_user_recived']; ?></td>
							<td style="border: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['address']; ?></td>
							<td>
								<form action="" method="POST">
									<input type="hidden" value="<?php echo $sql_assoc['id'] ?>" id="id" name="id">
									<input class="btn btn-primary" type="submit" id="view" name="view" value="View">
									<input class="btn btn-danger" onclick="return confirm('¿Block Send?');" type="submit" id="block" name="block" value="Block">
									<input class="btn btn-secundary" onclick="return confirm('¿Unlock Send?');" type="submit" id="unlock" name="unlock" value="Unlock">
								</form>
							</td>
							
						<?php	 
							}
						?>

					<div style="postion:relative; float: right; margin-top: 400px; margin-right: 170px">
						<form action="" method="post">
							<input type="hidden" value="<?php echo $npagina ?>" id="npag">
						<?php
							for ($i=1; $i <= $numpags; $i++) { 
								echo '<input type="submit" value="'.$i.'" name="pagina" id="pagina">';
							}
						?>
						</form>
					</div>
						<?php
							}
						?>
						</tr>
						</tbody>
					</table>
			
			<!-- VIEW SEND ARTICLE ########################################### -->

				<?php if ($type == 'v') { ?>
						<table style="border-collapse: collapse; border-color: white; display: inline-block; background-color: rgba(096,111,140,0.3); " border="4px">
						<tr>
							<th>Code</th>
							<td>
								<input type="text" value="<?php echo $assoc_view['code']; ?>">
							</td>
						</tr>
						<tr>
							<th>Message</th>
							<td>
								<input type="text" value="<?php echo $assoc_view['message']; ?>">
							</td>
						</tr>
						<tr>
							<th>Status</th>
							<td>
								<input type="text" value="<?php echo $assoc_view['status']; ?>">
							</td>
						</tr>
						<tr>
							<th>Title</th>
							<td>
								<input type="text" value="<?php echo $assoc_view['title']; ?>">
							</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>
								<input type="text" value="<?php echo $assoc_view['address']; ?>">
							</td>
						</tr>
						<tr>
							<th>User Recived</th>
							<td>
								<?php 
									$query_user_recived = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_recived']."'");
									$assoc_user_recived = mysql_fetch_assoc($query_user_recived); 
								?>
								<input type="text" value="<?php echo $assoc_user_recived['username']; ?>">
							</td>
						</tr>
						<tr>
							<th>User Send</th>
							<td>
								<?php 
									$query_user_send = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_send']."'");
									$assoc_user_send = mysql_fetch_assoc($query_user_send); 
								?>
								<input type="text" value="<?php echo $assoc_user_send['username']; ?>">
							</td>
						</tr>
						<tr>
							<th>Item</th>
							<td>
								<?php 
									$query_item = mysql_query("SELECT * FROM item WHERE id = '".$assoc_view['id_item']."'");
									$assoc_item = mysql_fetch_assoc($query_item); 
								?>
								<input type="text" value="<?php echo $assoc_item['name']; ?>">
							</td>
						</tr>
						<tr></tr>
					</table>
					<br><input class="btn btn-primary" type="submit" onclick="history.back()" value="To Return">


				<?php } ?>

		</div>
	</div>
</div>



<?php
//include header template
require('layout/footer.php');
?>