<?php
require('layout/header.php');
?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	
	
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

	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>