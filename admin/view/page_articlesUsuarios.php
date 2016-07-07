<?php
require('layout/header.php');

$item_user = $_SESSION['id'];
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
						<th><p align="center">Description</p></th>
						<th width="200px"><p align="center">Actions</p></th>
					</tr>
				</thead>
					<?php
						$search_value = "";
						if(isset($_POST["s"]))
						{	
							$search_value=  $search_value." and ( ";
							$search_value=  $search_value." code like '%".$_POST["s"]."%'";
							$search_value=  $search_value." or code like '%".$_POST["s"]."%'";
							$search_value=  $search_value." or  name like '%".$_POST["s"]."%'";
							$search_value=  $search_value." or  description like '%".$_POST["s"]."%'";
							$search_value=  $search_value." or  type like '%".$_POST["s"]."%'";
							$search_value=  $search_value." ) ";
							echo $_POST["s"];
						}
						
						$query = "SELECT * FROM item WHERE id_user = '".$item_user."' ".$search_value;;
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
						<td><?php echo $sql_assoc['type']; ?></td>
						<td><a href="/item/?item_code=<?php echo $sql_assoc['code'];?>">ver</a> / x</td>
						
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