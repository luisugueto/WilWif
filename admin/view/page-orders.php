<?php 


if(isset($_POST['order_method']) && isset($_POST['order_code']))
{
	if($_POST['order_method'] =="block")
	{
		BlockOrder($_POST['order_code']);
	}elseif($_POST['order_method'] =="unblock")
	{
		UnblockOrder($_POST['order_code']);
	}
}

//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and od.code like '%".$searchValue."%' or od.message like '%".$searchValue."%' or od.status like '%".$searchValue."%' or od.id_item in (select id from item where code like '%".$searchValue."%') or od.id_user_send in ( select id from user where username like '%".$searchValue."%')";
$query = "SELECT od.*,i.code as itemCode, u.username as username FROM `order` od LEFT JOIN user u  ON od.id_user_send = u.id  LEFT JOIN item i  ON od.id_item = i.id  WHERE od.status!='Erased'".$searchValue. "group by od.code";

//echo $query;
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


/*
if (isset($_POST['view'])) {
	$sql_view = "SELECT * FROM submit WHERE id = '".$id."'";
	$query_view = mysql_query($sql_view);
	$assoc_view = mysql_fetch_assoc($query_view);
}
elseif(isset($_POST['block'])){
	$sql_block = "UPDATE submit SET status = 'Block' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
	header('Location: /orders/');
}
elseif(isset($_POST['unblock'])){
	$sql_block = "UPDATE submit SET status = 'Unlock' WHERE id = '".$id."'";
	$query_block = mysql_query($sql_block);
	header('Location: /orders/');
}*/



require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Orders</h2>
		</div>
		<form class="form_search" method="get" action="" >
			<p >Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value">
		</form>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter">
	
	<div class="content_result_div">
		<div class="content_grid_result">
			<div>
				<div class="header_container">
				<div class="header_container_result">
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						Code
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						Wilwif-Code
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Status
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Username
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						Options
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
								<?php echo $row['itemCode']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['status']; ?>	
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['username']; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<form action="/orders/order/"  method="get" class="form_option">
									<input type="hidden" name="order_code" value="<?php echo $row['code'];?>">
									<input type="hidden" name="order_method" value="view">
									<input class="search_option_result option_view" type="submit" value="">
								</form>
								<?php if($row['status'] != "On Hold")
								{
								?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="order_code" value="<?php echo $row['code'];?>">
										<input type="hidden" name="order_method" value="block">
										<input class="search_option_result option_locked" type="submit" value="">
									</form>
								<?php
								}else{
									?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="order_code" value="<?php echo $row['code'];?>">
										<input type="hidden" name="order_method" value="unblock">
										<input class="search_option_result option_unlocked" type="submit" value="">
									</form>
								<?php
								}
								?>
								
								<!--<form action="" method="POST">
									<input type="hidden" value="<?php echo $row['id'] ?>" id="id" name="id">
									<input type="submit" id="view" name="view" value="" style="width: 59px; background-image: url('/image/ver-56-56-02.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php if($row['status']!='Block') { ?>
									<input type="submit" onclick="return confirm(¿Block Order?)" id="block" name="block" value="" style="width: 59px; background-image: url('/image/bloquear-56-56.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php } elseif ($row['status']=='Block') { ?>
									<input type="submit" onclick="return confirm(¿Unlock Order?)" id="unlock" name="unlock" value="" style="width: 59px; background-image: url('/image/desbloquear-56-56.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
									<?php } ?>
								</form>-->
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
										<input type="submit" class="page_index" value ="1.">
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
	<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
					</div>
	</div>
	

		
</div>

<style>

</style>
<?php 
//include header template
require('layout/footer.php');
?>