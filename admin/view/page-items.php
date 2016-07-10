<?php
require('layout/header.php');

if(isset($_GET['id'])) { $id = $_GET['id']; }
$query = "SELECT * FROM item";
$sql = mysql_query($query);
$sql_row = mysql_num_rows($sql);

######### PAGINACIONN ###############
$nregistros = 4;
$nfilas = mysql_num_rows($sql);
$numpags = $nfilas / $nregistros;
if (isset($_POST['pagina']))	$npagina = $_POST['pagina']; else $npagina = 1;

$query .= " LIMIT ".((($npagina*$nregistros)-($nregistros-1))-1).", ".$nregistros;
$resultado = mysql_query($query);
$rows = mysql_num_rows($resultado);

############################################


$type = 'i';
if (isset($_POST['view'])) {
	$type = 'v';
	$code = $_POST['code'];
}
elseif(isset($_POST['block'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Block' WHERE code = '".$code."'");
	header('Location : /items/');
}	
elseif(isset($_POST['unlock'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Unlock' WHERE code = '".$code."'");
	header('Location : /items/');
}

?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-items-534-78-01.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 270px; font-family: arial,rial;">ITEMS</h1>
		</div>
	</div>
</div>
<div style="margin-top: 30px; width: 1176px; height: 600px; display: inline-block; background-color: rgba(096,111,140,0.3); border-radius: 50px;">
<div style="display: inline-block; background-color: transparent; border-radius: 50px; height: 550px; width: 1140px; border-style: solid; border-color: white; margin-top: 20px;">
	
	<div id="content_containter" style="margin-top: 40px; margin-left: -120px; margin-bottom: 50px; width: 1440px; display: inline-block;">
		
		<div style="border-radius: 50px; margin-left: -60px;">
<?php if ($type == 'i') { ?>
			<table style="border-color: white; border-radius: 50px; width: 1100px; display: inline-block; background-color: rgba(096,111,140,0.3); " border="4px">
				<thead style="border: 5px;" >
					<tr>
						<td width="400px" style="border-bottom: 0px solid; border-top: 0px; border-left: 0px; border-right: 0px solid; border-color: white;"><p style="color: white">Item Code</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 0px; border-left: 5px solid; border-right: 5px solid; border-color: white;"><p style="color: white">Name</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 0px; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white">Status</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 0px; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white">User Holder</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 0px; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white">Type</p></td>
						<td width="300px" style="border-bottom: 0px solid; border-top: 0px; border-left: 0px; border-right: 0px solid; border-color: white"><p style="color: white">Options</p></td>
					</tr>
				</thead>
				<tbody>
				<?php
						
						if($sql_row == 0)
						{
							echo "<tr>
									<td colspan='6' style='border-bottom: 0px solid; border-top: 5px solid; border-left: 0px; border-right: 0px solid; border-color: white;'><p style='color: white'>No have.</p></td>
								</tr>";
						}
						while($sql_assoc = mysql_fetch_assoc($resultado)){
					?>
					<tr>
						<td width="400px" style="border-bottom: 0px solid; border-top: 5px solid; border-left: 0px; border-right: 0px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['code']; ?></p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 5px solid; border-left: 5px solid; border-right: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['name']; ?></p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 5px solid; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['status']; ?></p></td>
						<td width="300px" style="border-bottom: 0px solid; border-top: 5px solid; border-left: 5px; border-right: 5px solid; border-color: white"><p style="color: white"><?php echo $sql_assoc['id_user']; ?></p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 0px solid; border-top: 5px solid; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['type']; ?></p></td>
						<td width="300px" style="border-bottom: 0px solid; border-top: 5px solid; border-left: 5px; border-right: 0px solid; border-color: white"><p style="color: white">x</p></td>
					</tr>
					<?php } ?>
			
				</tbody>
			</table>
			
			<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">

			<div style="clear: both; content: ''; display: table;">
				<div style="float: center; margin-left: 450px">
					<?php echo "<a href='/' style='text-decoration: none;'>";?>
						<img width="50" height="50" src="/image/boton-volver-57-57.png" style="cursor: pointer;">
						<p style="width: 62px; margin-top: 0px; margin-bottom: 0px; color:white;">Return</p>
					</a>
				</div>
			</div>
			<div style="postion:relative; float: right; margin-top: -80px; margin-right: 0px">
					<form action="" method="post">
						<input type="hidden" value="<?php echo $npagina ?>" id="npag">
					<?php
						for ($i=1; $i <= $numpags; $i++) { 
							echo '<input type="submit" value="'.$i.'" name="pagina" id="pagina">';
						}
					?>
					</form>
				</div>
			<?php } ?>
			
<!-- VIEW ITEM $$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
			<?php if ($type == 'v') { ?>
				<h2>Article</h2>
				<hr>
				<table align="center" class="table table-striped table-hover">
				<thead>		
					<tr>
						<th><p align="center">Code</p></th>
						<th><p align="center">Name</p></th>
						<th><p align="center">Description</p></th>
						<th><p align="center">Title</p></th>
						<th><p align="center">Status</p></th>
						<th><p align="center">Country</p></th>
						<th><p align="center">City</p></th>
						<th><p align="center">Lost Address</p></th>
						<th><p align="center">Create Date</p></th>
					</tr>
				</thead>
					<?php
						$query = "SELECT * FROM item WHERE code = '".$code."'";
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
						<td><?php echo $sql_assoc['title']; ?></td>
						<td><?php echo $sql_assoc['status']; ?></td>
						<td><?php echo $sql_assoc['country']; ?></td>
						<td><?php echo $sql_assoc['city']; ?></td>
						<td><?php echo $sql_assoc['findlost_address']; ?></td>
						<td><?php echo $sql_assoc['create_date']; ?></td>

						<td>
						</td>
						
					<?php	 
						}
					?>
					</tr>
					</tbody>
				</table>
			<?php } ?>
		
		</div>
		
		</div>
		</div>
</div>
</div>







<?php 
//include header template
require('layout/footer.php');
?>