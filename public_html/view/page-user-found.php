<?php
require('layout/header.php');
?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
				<h2>Articles</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Name</p></th>
						<th><p align="center">Description</p></th>
						<th width="200px"><p align="center">Action</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM item WHERE id_user = '".$_SESSION['id']."' AND status != 'Deleted'";
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
						<td><?php echo "<a href='/foundView/?code=$sql_assoc[code]&type=v'>View </a>";
							?>
						</td>
						
					<?php	 
						}
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