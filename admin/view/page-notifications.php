<?php

require('layout/header.php');
?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="background-image: url('/image/barra-notificaciones-534-78.png'); background-repeat: no-repeat; width: 540px; height: 82px; display: inline-block; margin-left: -425px; margin-top: 15px;">
		<h2 style="height: 38px; color: white; width: 220px; font-family: arial,rial; margin-left: 83px; padding-top: 10px;">NOTIFICATIONS</h2>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	

	<div class="row">

	    <div class="table-responsive">
				<h2>Notifications</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Username</p></th>
						<th><p align="center">Message</p></th>
						<th><p align="center">Status</p></th>
						<th width="200px"><p align="center">Actions</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM notifications";
						$sql = mysql_query($query);
						$sql_assoc = mysql_fetch_assoc($sql);
						do{
					?>
				<tbody>
					<tr>
						<td><?php 
						$query_user = mysql_query("SELECT * FROM user WHERE id = '".$sql_assoc['id_user']."'");
						$assoc_user = mysql_fetch_assoc($query_user);
						echo $assoc_user['username']; ?>
						</td>
						<td><?php echo $sql_assoc['message']; ?></td>
						<td><?php echo $sql_assoc['status']; ?></td>
						<td>x</td>
						
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