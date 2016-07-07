<?php
require('layout/header.php');

$sql = "SELECT * FROM submit WHERE id_user_send = '".$_SESSION['id']."'";
$query = mysql_query($sql) or die(mysql_error());

$type = 'p';
$id = $_POST['id'];

if (isset($_POST['view'])) {
	$type = 'v';
	$sql_view = "SELECT * FROM submit WHERE id = '".$id."'";
	$query_view = mysql_query($sql_view);
	$assoc_view = mysql_fetch_assoc($query_view);
}
elseif(isset($_POST['block'])){
	$sql_block = "UPDATE submit SET status = 'Block' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
}
elseif(isset($_POST['unlock'])){
	$sql_block = "UPDATE submit SET status = 'Unlock' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
}
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
	
	<div class="row">

	    <div class="table-responsive">
				<h2>Shipment</h2>
				<hr>
			<?php if ($type == 'p') { ?>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Status</p></th>
						<th width="200px"><p align="center">Action</p></th>
					</tr>
				</thead>
					<?php
						$sql_row = mysql_num_rows($query);
						if($sql_row == 0)
						{
							echo "<tr>
									<td colspan='4'>No tiene envios.</td>
								</tr>";
						}
						while($sql_assoc = mysql_fetch_assoc($query)){
					?>
				<tbody>
					<tr>
						<td><?php echo $sql_assoc['code']; ?></td>
						<td><?php echo $sql_assoc['status']; ?></td>
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
					</tr>
					</tbody>
				</table>
			<?php } ?>

	<!-- VIEW SEND ARTICLE ########################################### -->

			<?php if ($type == 'v') { ?>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Message</p></th>
						<th><p align="center">Status</p></th>
						<th><p align="center">Title</p></th>
						<th><p align="center">Address</p></th>
						<th><p align="center">User Recived</p></th>
						<th><p align="center">Item</p></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $assoc_view['code']; ?></td>
						<td><?php echo $assoc_view['message']; ?></td>
						<td><?php echo $assoc_view['status']; ?></td>
						<td><?php echo $assoc_view['title']; ?></td>
						<td><?php echo $assoc_view['address']; ?></td>
						<td><?php 
							$query_user = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_recive']."'");
							$assoc_user = mysql_fetch_assoc($query_user);
							echo $assoc_user['username']; ?>
						</td>
						<td><?php 
							$query_item = mysql_query("SELECT * FROM item WHERE id = '".$assoc_view['id_item']."'");
							$assoc_item = mysql_fetch_assoc($query_item);
							echo $assoc_item['name']; ?>
						</td>
					</tr>
					</tbody>
				</table>
				<input class="btn btn-primary" type="submit" onclick="history.back()" value="To Return">

			<?php } ?>

		</div>
	</div>
</div>

	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>