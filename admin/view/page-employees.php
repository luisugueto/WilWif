<?php 
if(isset($_POST['employee_method']) &&  isset($_POST['username']))
{
	if($_POST['employee_method'] == "blocked")
	{
		BlockUser($_POST['username']);
		CreateRecord('Block Employee',"username:".$_POST['username']);
	}else if($_POST['employee_method'] == "unblocked"){
		UnblockUser($_POST['username']);
		CreateRecord('Unblock Employee',"username:".$_POST['username']);
	}
}


//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (username like '%".$searchValue."%' or email like '%".$searchValue."%' or name like '%".$searchValue."%' )";
$query = "SELECT * FROM user WHERE status!='Erased' and rol_id in (select id from rol where code !='001' )".$searchValue; // and code !='010'
 
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



require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Employees</h2>
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
						Username
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						E-mail
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Name
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Status
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
								<?php echo $row['username']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_1_3">
								<?php echo $row['email']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['name']; ?>	
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['status']; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<form action="/employees/employee/" method="get" class="form_option">
								<input type="hidden" value="<?php echo $row['username']; ?>" name="employeeusername" id="id">
								<input class="search_option_result option_view" type="submit" id="view" name="view" value="">
								</form>
								
								<?php if($row['status'] != "Block")
								{
								?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="username" value="<?php echo $row['username'];?>">
										<input type="hidden" name="employee_method" value="blocked">
										<input class="search_option_result option_locked" type="submit" value="">
									</form>
								<?php
								}else{
									?>
									<form action=""  method="post"  class="form_option">
										<input type="hidden" name="username" value="<?php echo $row['username'];?>">
										<input type="hidden" name="employee_method" value="unblocked">
										<input class="search_option_result option_unlocked" type="submit" value="">
									</form>
								<?php
								}
								?>
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
						<div class="option_container_page" >
							<a href="/employees/employee/">
								<input class="search_option_result option_add" type="button" name="add" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Add</p>
							</a>
						</div>
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