<?php 
//include header template

$searchValue = (isset($_GET['s']))?  $_GET['s'] : '';
if($searchValue =='')
$searchValue = (isset($_POST['s']))?  $_POST['s'] : '';

$searchValue = ($searchValue == '' )? '':" where (code like '%".$searchValue."%' or id_user_create in ( select id from user where username like '%".$searchValue."%') or  id_user_invited in ( select id from user where username like '%".$searchValue."%'  ))";

############################################

require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Chats</h2>
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
						Creator
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Invited
					</div>
					<div class="header_column_result header_column_1_5 column_cel_no_display">
						Date
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
								<?php echo $row['creator']; ?>
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['invited']; ?>	
							</div>
							<div class="row_column_result header_column_1_5 column_cel_no_display">
								<?php echo $row['date']; ?>
							</div>
							<div class="row_column_result header_column_1_5  column_cel_1_3">
								<?php
									if( $_SESSION['id']==$row['creator_id'] || $_SESSION['id']==$row['invited_id'])
									{
								?>
									<form action="/chats/chat/" target="empty" method="post"  style="height: 68px; float: left; margin-left: 10px;">
										<input type="hidden" name="chat_code" value="<?php echo $row['code'];?>">
										<input type="hidden" name="chat_method" value="open">
										<input class="search_option_result option_open" type="submit" value="">
									</form>
								<?php
									}
								?>
								<form action="/chats/view/" method="post"  style="height: 68px; float: left; margin-left: 10px;">
									<input type="hidden" name="chat_code" value="<?php echo $row['code'];?>">
									<input type="hidden" name="chat_method" value="view">
									<input class="search_option_result option_view" type="submit" value="">
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
	<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/chats/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
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