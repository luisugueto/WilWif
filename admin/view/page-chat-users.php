<?php 
//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" and (username like '%".$searchValue."%' or email like '%".$searchValue."%' or name like '%".$searchValue."%' )";
$query = "SELECT * FROM user WHERE last_mod_date  > date_sub(now(), interval 1 minute)  and rol_id = (select id from rol where code ='001')".$searchValue;

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
			<h2 class="header_title_1">Online Users</h2>
		</div>
		<form class="form_search" method="get" action="/chats/users/" >
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
								<?php echo "Online"; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<form action="/chats/chat/" target="empty" method="post">
									<input type="hidden" name="user_invite" value="<?php echo $row['id'];?>">
									<input type="hidden" name="chat_method" value="create">
									<input type="submit" value="" style="width: 59px; background-image: url('/image/botones-usuarios-online-56-56-02.png'); border-width: 0px; padding-left: 0px; padding-right: 0px; height: 59px; background-color: transparent; cursor: pointer;">
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