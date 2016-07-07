<?php
require('layout/header.php');
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
						<td><?php echo "<a href='/users/edit/?id=$sql_assoc[id]'> Edit </a> /
										";
										if ($sql_assoc['blocked'] == 1) {
											echo "<a href='/users/unlock/?id=$sql_assoc[id]'> Unlock </a> /";
										}
										else{
											echo "<a href='/users/block/?id=$sql_assoc[id]'> Lock </a> /";
										}

								echo "<a href='/items/?id=$sql_assoc[id]'> Articles </a> /
									  <a href='/records/?id=$sql_assoc[id]'> History / </a>
									  <a href='/notifications/notification/?id=$sql_assoc[id]'> Add Notification </a>"; ?></td>
						
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