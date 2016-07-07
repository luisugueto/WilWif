<?php
require('layout/header.php');

$id = $_GET['id'];
?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
				<h2>History</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Action</p></th>
						<th><p align="center">Date</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM history WHERE id_user = '".$id."'";
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
						<td><?php echo $sql_assoc['action']; ?></td>
						<td><?php echo $sql_assoc['date']; ?></td>						
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