<?php 
//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (username like '%".$searchValue."%' or email like '%".$searchValue."%' or name like '%".$searchValue."%' )";
$query = "SELECT * FROM user WHERE rol_id in (select id from rol where code !='001' and code !='010')".$searchValue;
 
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
			<h2 class="header_title_1">EMPLOYEES</h2>
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
		<div class="content_grid_result">
			<div>
				<div class="header_container">
				<div class="header_container_result">
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						USERNAME
					</div>
					<div class="header_column_result header_column_1_5 column_cel_1_3">
						E-MAIL
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						NAME
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						STATUS
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
								<form action="/employees/viewemployee" method="post">
								<input type="hidden" value="<?php echo $row['id']; ?>" name="id" id="id">
								<input class="btn btn-primary" type="submit" id="view" name="view" value="" style="background:url('/image/ver-56-56-02.png'); width: 60px; height: 60px; border: 0px">
								</form>
							</div>
						</div>
						<?php
					}
					?>
				<div>
					<?php echo "<a style='text-decoration: none;' href='/employees/employee'>";?>
						<img width="50" height="50" src="/image/boton-crear-40-40.png" style="cursor: pointer;">
						<p style="color: white; margin-top: -10px">Add</p>
					</a>
				</div>
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
</div>
</div>
<?php 
//include header template
require('layout/footer.php');
?>