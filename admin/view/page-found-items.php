<?php

if (isset($_POST['item_method']) && isset($_POST['item_code'])) {
	$item_method = $_POST['item_method'];
	$item_code = $_POST['item_code'];
	
	if($item_method == "view")
	{
	
	}else if($item_method == "locked")
	{
		$query = "UPDATE item SET status = 'Locked' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
	
	}else if($item_method == "unlocked")
	{
		$query = "UPDATE item SET status = 'Active' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
	
	}else if($item_method == "deleted")
	{
		$query = "UPDATE item SET status = 'Erased' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
	
	}
}

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (i.code like '%".$searchValue."%' or i.name like '%".$searchValue."%' or i.status like '%".$searchValue."%' or i.id_user in ( select id from user where username like '%".$searchValue."%'))";
$query = "SELECT i.*, u.username as username FROM item i ";
$query = $query. " LEFT JOIN user u  ON i.id_user = u.id  where i.status !='Erased' and type='Found' ";
$query = $query.$searchValue ." GROUP BY i.code";
$sql = mysql_query($query);

######### PAGINACIONN ###############
$total = mysql_num_rows($sql);
$total = ($total < 1)?1: $total;
$nrows = 10;
$totalpages = ceil($total/$nrows);
$page = isset($_POST['page'])? $_POST['page']:1;

$query .= " LIMIT ".(($page-1)*$nrows).",".$nrows;
$sql = mysql_query($query);
$records = mysql_num_rows($sql);

############################################
require('layout/header.php');
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_item">
			<h1 class="header_title_1">Found Items</h1>
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
<div id="content">

<div id="content_containter" >
		
		
		<div class="content_result_div">
		<div class="content_grid_result">
			<div>
				<div class="header_container">
				<div class="header_container_result">
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						Code
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Name
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Status
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						User Holder
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
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['name']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['status']; ?>	
							</div>
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								<?php echo $row['username']; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<form action="/items/found/item"  method="post" class="form_option">
									<input type="hidden" name="item_code" value="<?php echo $row['code'];?>">
									<input type="hidden" name="item_method" value="view">
									<input class="search_option_result option_view" type="submit" value="">
								</form>
								<?php if($row['status'] != "Locked")
								{
								?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="item_code" value="<?php echo $row['code'];?>">
										<input type="hidden" name="item_method" value="locked">
										<input class="search_option_result option_locked" type="submit" value="">
									</form>
								<?php
								}else{
									?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="item_code" value="<?php echo $row['code'];?>">
										<input type="hidden" name="item_method" value="unlocked">
										<input class="search_option_result option_unlocked" type="submit" value="">
									</form>
								<?php
								}
								?>
								
								<form action=""  method="post"  class="form_option">
									<input type="hidden" name="item_code" value="<?php echo $row['code'];?>">
									<input type="hidden" name="item_method" value="deleted">
									<input class="search_option_result option_deleted" type="submit" value="">
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
						for($i = $mini ; $i<=$maxi;$i++)
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
</div>		
		
		
		
		
		
		
		
	
<?php 
//include header template
require('layout/footer.php');
?>