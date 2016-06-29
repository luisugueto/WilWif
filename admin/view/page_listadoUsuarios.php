<?php

require('layout/header.php');
?>

<div class="container">

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
						<td><?php echo "<a href='/modificarUsuario/?id=$sql_assoc[id]'> Edit </a> /
										";
										if ($sql_assoc['blocked'] == 1) {
											echo "<a href='/desbloquearUsuario/?id=$sql_assoc[id]'> Unlock </a> /";
										}
										else{
											echo "<a href='/bloquearUsuario/?id=$sql_assoc[id]'> Lock </a> /";
										}

								echo "<a href='/articlesUsuario/?id=$sql_assoc[id]'> Articles </a> /
										<a href='/historyUsuario/?id=$sql_assoc[id]'> History </a>"; ?></td>
						
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