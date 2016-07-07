<?php

require('layout/header.php');
?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-notificaciones-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 270px; font-family: arial,rial;">NOTIFICATIONS</h1>
		</div>
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
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