<?php
require('layout/header.php');

$id = $_GET['id'];
$type = 'i';
if (isset($_POST['view'])) {
	$type = 'v';
	$code = $_POST['code'];
}
elseif(isset($_POST['block'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Block' WHERE code = '".$code."'");
	header('Location : /items/');
}	
elseif(isset($_POST['unlock'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Unlock' WHERE code = '".$code."'");
	header('Location : /items/');
}

?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
			<?php if ($type == 'i') { ?>
				<h2>Articles</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Name</p></th>
						<th><p align="center">Description</p></th>
						<th width="200px"><p align="center">Actions</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM item WHERE id_user = '".$id."'";
						$sql = mysql_query($query);
						$sql_row = mysql_num_rows($sql);
						if($sql_row == 0)
						{
							echo "<tr>
									<td colspan='4'>No tiene articulos.</td>
								</tr>";
						}
						while($sql_assoc = mysql_fetch_assoc($sql)){
					?>
				<tbody>
					<tr>
						<td><?php echo $sql_assoc['code']; ?></td>
						<td><?php echo $sql_assoc['name']; ?></td>
						<td><?php echo $sql_assoc['description']; ?></td>
						<td>
					<form action="" method="post">
						<input type="hidden" id="code" name="code" value="<?php echo $sql_assoc['code']; ?>">
						<input type="submit" class="btn btn-primary" value="View" id="view" name="view">
					<?php if($sql_assoc['status'] != 'Block'){ ?>
						<input type="submit" class="btn btn-danger" onclick="return confirm('¿Block Item?');" value="Block" id="block" name="block">
					<?php } elseif ($sql_assoc['status'] == 'Block') { ?>
						<input type="submit" class="btn btn-secundary" onclick="return confirm('¿Unlock Item?');" value="Unlock" id="unlock" name="unlock">
					<?php } ?>
					</form>
						</td>
						
					<?php	 
						}
					?>
					</tr>
					</tbody>
				</table>
			<?php } ?>
			<!-- VIEW ITEM $$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
			<?php if ($type == 'v') { ?>
				<h2>Article</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Name</p></th>
						<th><p align="center">Description</p></th>
						<th><p align="center">Title</p></th>
						<th><p align="center">Status</p></th>
						<th><p align="center">Country</p></th>
						<th><p align="center">City</p></th>
						<th><p align="center">Lost Address</p></th>
						<th><p align="center">Create Date</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM item WHERE code = '".$code."'";
						$sql = mysql_query($query);
						$sql_row = mysql_num_rows($sql);
						if($sql_row == 0)
						{
							echo "<tr>
									<td colspan='4'>No tiene articulos.</td>
								</tr>";
						}
						while($sql_assoc = mysql_fetch_assoc($sql)){
					?>
				<tbody>
					<tr>
						<td><?php echo $sql_assoc['code']; ?></td>
						<td><?php echo $sql_assoc['name']; ?></td>
						<td><?php echo $sql_assoc['description']; ?></td>
						<td><?php echo $sql_assoc['title']; ?></td>
						<td><?php echo $sql_assoc['status']; ?></td>
						<td><?php echo $sql_assoc['country']; ?></td>
						<td><?php echo $sql_assoc['city']; ?></td>
						<td><?php echo $sql_assoc['findlost_address']; ?></td>
						<td><?php echo $sql_assoc['create_date']; ?></td>

						<td>
						</td>
						
					<?php	 
						}
					?>
					</tr>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div>
</div>

<?php
//include header template
require('layout/footer.php');
?>