<?php
require('layout/header.php');

if(isset($_POST['id'])){ $id = $_POST['id']; }

if(isset($_POST['block']))
{
	$query = mysql_query("UPDATE user SET blocked = '1' WHERE id = '".$id."'");
	header('Location = ./');
}
elseif(isset($_POST['unlock']))
{
	$query = mysql_query("UPDATE user SET blocked = 'NULL' WHERE id = '".$id."'");
	header('Location = ./');
}

?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="background-image: url('/image/barra-usuarios-534-78.png'); background-repeat: no-repeat; width: 540px; height: 82px; display: inline-block; margin-left: -425px; margin-top: 15px;">
		<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;margin-left: 83px;">USERS</h1>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	

	<div class="row">

	    <div class="table-responsive">
				<h2>Users</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Name</p></th>
						<th><p align="center">Username</p></th>
						<th><p align="center">Email</p></th>
						<th width="200px"><p align="center">Actions</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM user WHERE rol_id != '1'";
						$sql = mysql_query($query);
						$sql_assoc = mysql_fetch_assoc($sql);
						do{
					?>
				<tbody>
					<tr>
						<td><?php echo $sql_assoc['name']; ?></td>
						<td><?php echo $sql_assoc['username']; ?></td>
						<td><?php echo $sql_assoc['email']; ?></td>
					<form action="" method="post">
						<td>
							<input type="hidden" value="<?php echo $sql_assoc['id']; ?>" id="id" name="id">
							<input type="submit" value="Edit" id="edit" name="edit">
							<?php if($sql_assoc['blocked'] == 1) { ?>
							<input onclick="return confirm('¿Unlock User?')" type="submit" value="Unlock" id="unlock" name="unlock">
							<?php } else { ?>
							<input onclick="return confirm('Block User?')" type="submit" value="Block" id="block" name="block">
							<?php } ?>
							<input type="button" value="Items" id="items" name="items" onclick="window.location.href='/items/?id=<?php echo $sql_assoc['id']; ?>'">
							<input type="button" value="History" id="records" name="history" onclick="window.location.href='/records/?id=<?php echo $sql_assoc['id']; ?>'">
							<input type="button" value="Notifications" id="notifications" name="notifications" onclick="window.location.href='/notifications/notification/?id=<?php echo $sql_assoc['id']; ?>'">
						</td>
					</form>
					<?php	 
						}while($sql_assoc = mysql_fetch_assoc($sql));
					?>
					</tr>
					</tbody>
				</table>
		</div>
	</div>
</div>

</div>
</div>

<?php 
//include header template
require('layout/footer.php');
?>