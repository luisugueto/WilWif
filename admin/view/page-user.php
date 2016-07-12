<?php
require('layout/header.php');

if(isset($_GET['type']))
{
	$id = $_GET['id'];
	$type = $_GET['type'];
	if ($type == 'r') 
	{
		$query_block = mysql_query("UPDATE user SET status = 'Deleted' WHERE id = '".$id."'") or die("error");
 		header('Location: /users/');
	}
	elseif($type == 'b')
	{
		$query_block = mysql_query("UPDATE user SET status = 'Block' WHERE id = '".$id."'") or die("error");
		header('Location: /users/');
	}
	elseif($type == 'u')
	{
		$query_block = mysql_query("UPDATE user SET status = 'Unlock' WHERE id = '".$id."'") or die("error");
		header('Location: /users/');
	}

}

$query = mysql_query("SELECT * FROM user WHERE id = '".$_POST['id']."'");
$assoc = mysql_fetch_assoc($query);
?>

<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">USER</h2>
		</div>
		<form class="form_search" method="get" action="" >
			<p >Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value">
		</form>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
	
	</div>
</div>
<div id="content_containter">
	
	<div class="content_result_div">

<div class="images_holder">
</div>

	<table style="border-color: white; display: inline-block; " border="0px;">
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">User Name</p>
						<input type="text" value="	<?php echo $assoc['username']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Email</p>
						<input type="text" value="	<?php echo $assoc['email']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Name</p>
						<input type="text" value="	<?php echo $assoc['name']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Last Name</p>
						<input type="text" value="	<?php echo $assoc['lastname']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Status</p>
						<input type="text" value="	<?php echo $assoc['status']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Security Question</p>
						<input type="text" value="	<?php echo $assoc['security_question']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Security</p>
						<input type="text" value="	<?php echo $assoc['security_answer'] ?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Login Attemps</p>
						<input type="text" value="	<?php ?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Creation Date</p>
						<input type="text" value="	<?php echo $assoc['create_date']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 0px; color: white; font-size: 18px; margin-top: 5px;">Modification Date</p>
						<input type="text" value="	<?php echo $assoc['last_mod_date']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
			</table>

		<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">
		
			<div style="clear: both; content: ''; display: table; float:right;">
			<form>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/users/'>";?>
						<img width="50" height="50" src="/image/boton-volver-57-57.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
					</a>
				</div>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/users/'>";?>
						<img width="50" height="50" src="/image/boton-cancelar-57-57.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Cancel</p>
					</a>
				</div>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/users/user/?type=r&id=$assoc[id]'>";?>
						<img width="50" height="50" src="/image/boton-eliminar-57-57.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Remove</p>
					</a>
				</div>
				<?php if ($assoc['status']!='Block') { ?>	
				
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/users/user/?type=b&id=$assoc[id]'>";?>
						<img width="50" height="50" src="/image/boton-bloquear-57-57.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Block</p>
					</a>
				</div>
				 <?php } elseif ($assoc['status'] == 'Block') { ?>
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a style='text-decoration: none;' href='/users/user/?type=u&id=$assoc[id]'>";?>
						<img width="50" height="50" src="/image/desbloquear-56-56.png" style="cursor: pointer;">
						<p style="color: white; width: 62px; margin-top: 0px; margin-bottom: 0px;">Unlock</p>
					</a>
				</div>
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