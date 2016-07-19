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
		CreateRecord('Locked Item',"wilwif code:".$item_code);
		
	
	}else if($item_method == "unlocked")
	{
		$query = "UPDATE item SET status = 'Active' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
		CreateRecord('Unlock Item',"wilwif code:".$item_code);
	
	}else if($item_method == "deleted")
	{
		$query = "UPDATE item SET status = 'Erased' WHERE code = '".$item_code."'";
		$sql = mysql_query($query);
		CreateRecord('Delete Item',"wilwif code:".$item_code);
		
	}
}

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (i.code like '%".$searchValue."%' or i.name like '%".$searchValue."%' or i.status like '%".$searchValue."%' or brand like '%".$searchValue."%' or number like '%".$searchValue."%' or model like '%".$searchValue."%' or color like '%".$searchValue."%' or i.id_user in ( select id from user where username like '%".$searchValue."%'))";
$query = "SELECT i.*, u.username as username FROM item i ";
$query = $query. " LEFT JOIN user u  ON i.id_user = u.id  where i.status !='Erased' ";
$query = $query.$searchValue ." GROUP BY i.code";
$sql = mysql_query($query);

######### PAGINACIONN ###############
$total = mysql_num_rows($sql);
$total = ($total < 1)?1: $total;
$nrows = 5;
$totalpages = ceil($total/$nrows);
$page = isset($_POST['page'])? $_POST['page']:1;

$query .= " LIMIT ".(($page-1)*$nrows).",".$nrows;
$sql = mysql_query($query);
$records = mysql_num_rows($sql);


if($records < 1 && !isset($_GET['s']))
{
	$page=0;
}

############################################
require('layout/header.php');
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png'); height:100px">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/'>
			<p class="fontsize_3" style="margin-bottom: 0px;"><img src="/image/flecha2-27-46.png">back</p>
		</a>
		</div>
		
		<div class="col-xs-6 col-md-6">	
			<a href="/">
				<img style="margin-top: 2%; margin-bottom: 3%;" src="/image/Logotipo-110-x-32.png" title="logo" width="110" height="32" >
			</a>
		</div>
		<div class="col-xs-3 col-md-3">
		
		</div>
	</div>
</header>
<div id="content">
			<div class="row">
					<div class="col-xs-12 col-md-12 fontsize_4">
						<form method="get" action="" >
							<input type="text" placeholder="Search" style="height: 31px; background-image: url('/image/lupa_31x31.png'); background-repeat: no-repeat; background-size: 25px 25px; background-position: right center; text-align: center;" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" >
						</form>
					</div>
				</div>
				<?php 
					
						while($row = mysql_fetch_assoc($sql))
						{
						?>
							
								<div class="row" >
								
								<div class="col-xs-12 col-md-12 ">
								<a href="/items/found/item/?item_code=<?php echo $row['code']?>">
								<div class="row_item" style="background-color:white">
								<p class="item_result_line">
									<label  style="color:black" class="fontsize_4"><span><strong><?php echo $row['title'];?> of </strong></span><span  class="fontsize_4" style="color:black"><?php echo $row['username'];?></span></label>
								</p>
								<p class="item_result_line">
									<label class="result_item_label" style="color:gray" class="fontsize_5"><span>Code:</span><span  class="fontsize_5"style="color:orange"><?php echo $row['code']; ?></span></label><label class="result_item_label"><span style="color:gray" class="fontsize_5">Country:</span><span style="color:orange"><?php echo $row['country']; ?></span></label>
								</p>
								<p class="item_result_line">
									<label class="result_item_label" style="color:gray" class="fontsize_5"><span>Date:</span><span  class="fontsize_5" style="color:orange"><?php echo (new DateTime($row['create_date']))->format('m-d-y');?></span></label><label class="result_item_label"><span style="color:gray" class="fontsize_5">City:</span><span style="color:orange"><?php echo $row['country']; ?></span></label>
								</p>
								</div>
									</a>
								</div>
								</div>
							
						
						<?php
					}
					?>
				
				
			<div class="row" style="height:50px">
					<div class="col-xs-12 col-md-12 fontsize_2">
					
					<div class="maxpr">	
				
				
					<?php 
						if($totalpages > 1)
						{
						
						
						$maxi = ($page+2 <= $totalpages )? $page+2: (($page+1 <= $totalpages )? $page+1: $totalpages);
						$mini = ($page-2 >= 1 )? $page-2: (($page-1 >= 1 )? $page-1: 1);
						for($i = $mini ; $i<=$maxi;$i++)
						{
							if($i ==$page-2 && $i != 1)
							{
								?>
									<form action="" method="post" style="float:left">
										<input type="hidden" name="page" value=1>
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input submit class="page_index" value ="1.">
									</form>
								<?php
							}
							
							
							
								if($i == $page)
							{
								?>
									<input type="submit" class="page_index current_page"style="float:left"  value ="<?php echo $i;?>">
								<?php
							}else{
								?>
									<form action="" method="post" style="float:left">
										<input type="hidden" name="page" value="<?php echo $i;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value ="<?php echo $i;?>">
									</form>
								<?php
							
							}
							
							
							if($i == $page+2 && $i != $totalpages)
							{
								?>
									<form action="" method="post" style="float:left">
										<input type="hidden" name="page" value="<?php echo $totalpages;?>">
										<input type="hidden" name="s" value="<?php if(isset($_POST['s'])){echo $_POST['s'];}?>">
										<input type="submit" class="page_index" value =".<?php echo $totalpages;?>">
									</form>
								<?php
							}
						}
					}
					?>
					
					</div>
					
					</div>
				</div>
		
	
</div>		
		
<style>

.result_item_label{

width:50%;
}
.row_item{
	background-color: white;
	border-width: 1px;
	color: orange;
	margin-left: 10px;
	margin-right: 10px;
	margin-top: 5px;
	padding-left: 20px;
	padding-right: 20px;
	text-align: left;
	width: 320px;
	margin:auto;
	border-radius:10px;

}

.row_item span{

}
.maxpr{
	margin:auto;
	width: 316px;
	text-align:right
	display:tablet;
}
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
	.row_item
	{
		width: 500px;	
	}

.maxpr{
	
	width: 474px;
}
 

}
</style>	
		
		
		
		
		
	
<?php 
//include header template
$actualpage = "Item Management";
require('layout/footer.php');
?>