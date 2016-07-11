<?php
require('layout/header.php');

$query = "SELECT * FROM user WHERE rol_id != '1'";
$sql = mysql_query($query);
$sql_assoc = mysql_fetch_assoc($sql);
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

?>

<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-notificaciones-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 270px; font-family: arial,rial;">USERS</h1>
		</div>
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div><div id="content_containter">
	<div class="content_div_1">
		<div class="div_inline-block">
		
		<div >
			<table>
				<thead style="border: 5px;" >
					<tr>
						<td width="400px" style="border-bottom: 5px solid; border-top: 0px; border-left: 0px; border-right: 0px solid; border-color: white;"><p style="color: white">User Name</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 5px solid; border-top: 0px; border-left: 5px solid; border-right: 5px solid; border-color: white;"><p style="color: white">Email</p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 5px solid; border-top: 0px; border-left: 0px; border-right: 5px solid; border-color: white;"><p style="color: white">Status</p></td>
						<td width="300px" style="border-bottom: 5px solid; border-top: 0px; border-left: 0px; border-right: 0px solid; border-color: white"><p style="color: white">Options</p></td>
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
						<td width="300px" style="border: 5px solid; border-bottom: 5px solid; border-top: 0px solid; border-left: 0px solid; border-right: 0px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['username']; ?></p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 5px solid; border-top: 0px solid; border-left: 5px solid; border-right: 5px solid; border-color: white;"><p style="color: white"><?php echo $sql_assoc['email']; ?></p></td>
						<td width="300px" style="border-bottom: 5px solid; border-top: 0px solid; border-left: 5px; border-right: 5px solid; border-color: white"><p style="color: white"><?php echo $sql_assoc['status']; ?></p></td>
						<td width="300px" style="border: 5px solid; border-bottom: 5px solid; border-top: 0px solid; border-left: 0px; border-right: 0px solid; border-color: white;"><p style="color: white">
						<form action="/users/user" method="post">
							<input type="hidden" value="<?php echo $sql_assoc['id']; ?>" name="id" id="id">
							<input class="btn btn-primary" type="submit" id="view" name="view" value="" style="background:url('/image/ver-56-56-02.png'); width: 60px; height: 60px; border: 0px">
						</form>
						</p></td>
					</tr>
					<?php } ?>
			
				</tbody>
			</table>
			
		<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">
		
			<div style="clear: both; content: ''; display: table; float: left; margin-left: 400px">
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/'>";?>
						<img width="50" height="50" src="/image/boton-volver-57-57.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
					</a>
				</div>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;'>";?>
						<img width="50" height="50" src="/image/boton-crear-40-40.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Add</p>
					</a>
				</div>
			</div>
		
		</div>

			<div style="postion:relative; float: right; margin-top: 10px; margin-right: 0px">
					<form action="" method="post">
						<input type="hidden" value="<?php echo $npagina ?>" id="npag">
					<?php
						for ($i=1; $i <= $numpags; $i++) { 
							echo '<input type="submit" value="'.$i.'" name="pagina" id="pagina">';
						}
					?>
					</form>
			</div>
		</div>
</div>

<style>
.header_div_1
{
	height: 112px;
	background-image: url('/image/header2-1440-112.png');
	background-repeat: no-repeat;
	background-size: 100% auto;
	width: 100%;"

}
.header_div_2
{
	width: 1440px;
	display: inline-block;
	padding-right: 81px;
	padding-left: 221px;
	text-align: left;
}
.header_div_3
{
	background-repeat: no-repeat;
	height: 82px;
	display: inline-block;
	margin-left: 0px;
	margin-top: 15px;
	width: 540px;
	padding-left: 90px;
}

.header_div_home{
	background-image: url('/image/barra-home-534-78.png');
}
.header_title_1{
	height: 38px;
	color: white;
	width: 220px;
	font-family: arial,rial;
	margin-left: 83px;
}

#content_containter{
	margin-top: 50px;
	margin-bottom: 50px;
	width: 1440px;
	display: inline-block;
}

.content_div_1{
	display: inline-block;
	width: 1176px;
	height: 567px;
	background-image: url('/image/cuadro-home-1176-567.png');
	padding: 58px 54px 54px 58px;"
}

.div_inline{
	display: inline-block;
}

.home_option{
	height: 232px;
	width: 20%; 
	float: left;
	padding-top: 30px;
	color:white;	
}

.margin_top_0{
	margin-top: 0px;
}
</style>


<?php 
//include header template
require('layout/footer.php');
?>