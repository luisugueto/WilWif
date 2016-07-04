<?php
require('layout/header.php');

$sql = "SELECT * FROM `order`";
$query = mysql_query($sql) or die(mysql_error());

$type = 'p';
$id = $_POST['id'];

if (isset($_POST['view'])) {
	$type = 'v';
	$sql_view = "SELECT * FROM `order` WHERE `id` = '".$id."'";
	$query_view = mysql_query($sql_view);
	$assoc_view = mysql_fetch_assoc($query_view);
}
elseif(isset($_POST['block'])){
	$sql_block = "UPDATE `order` SET `status` = 'Block' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block) or die(mysql_error());
}
elseif(isset($_POST['unlock'])){
	$sql_block = "UPDATE `order` SET `status` = 'Unlock' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
}
?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
				<h2>Lost</h2>
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
								<input class="btn btn-primary" onclick="return confirm('¿Add Note?');" type="submit" id="note" name="note" value="Add Note">
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
							$query_user = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_recived']."'");
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

<?php
//include header template
require('layout/footer.php');
?>