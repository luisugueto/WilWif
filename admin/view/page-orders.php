<?php 
//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':"WHERE code like '%".$searchValue."%' or message like '%".$searchValue."%' or status like '%".$searchValue."%' ";
$query = "SELECT * FROM `order` ".$searchValue;

$sql = mysql_query($query);
$sql_assoc = mysql_fetch_assoc($sql);
$total = mysql_num_rows($sql);
$total = ($total < 1)?1: $total;
$nrows = 10;
$totalpages = ceil($total/$nrows);
$page = isset($_POST['page'])? $_POST['page']:1;
######### PAGINACION ###############


$query .= " LIMIT ".((($page*$nrows)-($nrows-1))-1).", ".$nrows;
$sql = mysql_query($query);
$records = mysql_num_rows($sql);



############################################


$type = 'p';
$id = isset($_POST['id']) ? $_POST['id'] : '';

if (isset($_POST['view'])) {
	$type = 'v';
	$sql_view = "SELECT * FROM `order` WHERE id = '".$id."'";
	$query_view = mysql_query($sql_view);
	$assoc_view = mysql_fetch_assoc($query_view);
}
elseif(isset($_POST['block'])){
	echo "si";
	$sql_block = "UPDATE `order` SET status = 'Block' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
	header('Location: /orders/');
}
elseif(isset($_POST['unlock'])){
	$sql_block = "UPDATE `order` SET status = 'Unlock' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
	header('Location: /orders/');
}



require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">ORDERS</h2>
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
	<?php if ($type == 'p') { ?>
	<div class="content_result_div">
		<div class="content_grid_result">
			<div>
				<div class="header_container">
				<div class="header_container_result">
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						CODE
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						ITEM
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						STATUS
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						MESSAGE
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						OPTIONS
					</div>
				</div>
				</div>
				<div class="result_container">
					<?php 
					
						while($row = mysql_fetch_assoc($sql))
						{
						?>
						<div class="row_container_result">
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								<?php echo $row['code']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								<?php 
									$query_item = mysql_query("SELECT * FROM item WHERE id = '".$row['id_item']."'");
									$assoc_item = mysql_fetch_assoc($query_item);
									echo $assoc_item['name'];
								?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['status']; ?>	
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['message']; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<form action="" method="POST">
									<input type="hidden" value="<?php echo $row['id'] ?>" id="id" name="id">
									<input type="submit" id="view" name="view" value="" style="width: 59px; background-image: url('/image/ver-56-56-02.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php if($row['status']!='Block') { ?>
									<input type="submit" onclick="return confirm(¿Block Order?)" id="block" name="block" value="" style="width: 59px; background-image: url('/image/bloquear-56-56.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php } elseif ($row['status']=='Block') { ?>
									<input type="submit" onclick="return confirm(¿Unlock Order?)" id="unlock" name="unlock" value="" style="width: 59px; background-image: url('/image/desbloquear-56-56.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php } ?>
								</form>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="pages_container">
					<div class="pages_container_index" style="display: inline-flex;">
					<?php 
						$maxi = ($page+2 <= $totalpages )? $page+2: (($page+1 <= $totalpages )? $page+1: $totalpages);
						$mini = ($page-2 >= 1 )? $page-2: (($page-1 >= 1 )? $page-1: 1);
						for($i = $mini ; $i<= $maxi;$i++)
						{
							if($i ==$page-2 && $i != 1)
							{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value=1>
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input submit class="page_index" value ="1.">
									</form>
								<?php
							}
							if($i == $page)
							{
								?>
									<input type="submit" class="page_index current_page" value ="<?php echo $i;?>">
								<?php
							}else{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value="<?php echo $i;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value ="<?php echo $i;?>">
									</form>
								<?php
							
							}
			
							if($i == $page+2 && $i != $totalpages)
							{
								?>
									<form action="" method="post">
										<input type="hidden" name="page" value="<?php echo $totalpages;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value =".<?php echo $totalpages;?>">
									</form>
								<?php
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- VIEW SEND ARTICLE ########################################### -->

				<?php if ($type == 'v') { ?>
			<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		
				</div>
			<table style="border-collapse: collapse; border-color: white; display: inline-block;" border="0px">
				<tr>

					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; text-align: center; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Code</p>
							<input type="text" value="	<?php echo $assoc_view['code']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Message</p>
							<input type="text" value="	<?php echo $assoc_view['message']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>

				</tr>
				<tr>
					
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Status</p>
							<input type="text" value="	<?php echo $assoc_view['status']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Title</p>
							<input type="text" value="	<?php echo $assoc_view['title']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>

				</tr>
				<tr>
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Address</p>
							<input type="text" value="	<?php echo $assoc_view['address']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>						
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Code</p>
							<input type="text" value="	<?php echo $assoc_view['code']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">User Send</p>
							<?php 
								$query_user_send = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_send']."'"); 
								$assoc_user_send = mysql_fetch_assoc($query_user_send);
							?>
							<input type="text" value="	<?php echo $assoc_user_send['username']?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>
					<td>
						<form method="post" action="" style="float: right; background-image: url('/image/barra-peq-518-48.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
							<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">User Recived</p>
							<?php 
								$query_user_recived = mysql_query("SELECT * FROM user WHERE id = '".$assoc_view['id_user_recived']."'"); 
								$assoc_user_recived = mysql_fetch_assoc($query_user_recived);
							?>
							<input type="text" value="	<?php echo $assoc_user_recived['username'];?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
						</form>
					</td>						
				</tr>
			</table>
			<br>
		<div style="width: 890px; display: inline-block; padding-top: 10px; padding-bottom: 10px;">
		
			<div style="clear: both; content: ''; display: table; float: right;">
				<div style="float: left; margin-right: 20px;">
					<?php echo "<a href='/orders/' style='text-decoration: none;'>";?>
						<img width="50" height="50" src="/image/boton-volver-57-57.png" style="cursor: pointer;">
						<p style="width: 62px; margin-top: 0px; margin-bottom: 0px; color:white;">Return</p>
					</a>
				</div>
			</div>
		
		</div>
				<?php } ?>

		</div>
	</div>
</div>
</div>
<script>
	$("#menu_button").click(function() {
		if($("#menu").hasClass( "menu_open" ))
		{
			$("#menu").removeClass( "menu_open" );
			$("#menu").addClass( "menu_close" );
		}else{
			$("#menu").removeClass( "menu_close" );
			$("#menu").addClass( "menu_open" );
		}
	});
	
</script>
<style>

</style>
<?php 
//include header template
require('layout/footer.php');
?>
