<?php

require('layout/header.php');
?>

<div class="container">

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

<?php
//include header template
require('layout/footer.php');
?>