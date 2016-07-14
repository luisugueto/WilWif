<?php
//include config
if(isset($_POST['create']))
{
	if(isset($_POST['username']) && isset($_POST['message'])){
		if(CreateNotification($_POST['username'],$_POST['message']))
		{
			header('Location: /notifications/');
		}
	}
} else if(isset($_GET['notification_id'])){

	$notification_id = $_GET['notification_id'];
	
	$query = "select n.*, u.username as username from notification n LEFT JOIN user u  ON n.id_user = u.id where n.id=".$notification_id." group by n.id";
	
	$sql = mysql_query($query);
	if($row = mysql_fetch_assoc($sql))
	{
		$message = $row ['message'];
		$create_date = $row ['create_date'];
		$username =  $row ['username'];
		$status =  $row ['status'];
		
		
	}
	

}else if(isset($_GET['username']))
{
	$user = new userInfo($_GET['username']);
	
	if(!isset($user->user_id))
	{
			die("User does not exist");
	}
	$username = $user->user_username;
}else{
	die("Access denied");
}

//define page title

//include header template
require('layout/header.php'); 
?>

<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Notification</h2>
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
<div id="content_containter" >
	<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">
				<div class="content_chat_div_1">
		
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="username" class="input_label_form">Username</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="username" class="input_text_form"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>" readonly>
							  </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($status)){ echo $status; } ?>"  readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="creation_date" class="input_label_form">Creation Date</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="creation_date" class="input_text_form"  id="creation_date"   value="<?php if(isset($create_date)){ echo $create_date; } ?>"require readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="textarea_container_form">
							  <div class="textarea_container_label_form" >
								<label for="message" class="input_label_form" >Message</label>
							  </div>
							  <div class="textarea_container_text_form">
								<textarea maxlength="200" type="text" name="message" class="textarea_text_form"  id="message" <?php if(isset($message)){ echo 'readonly'; } ?>><?php if(isset($message)){ echo $message; } ?></textarea>
							  </div>
						 </div>
					</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/notifications/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php if(!isset($_GET['notification_id'])){ 
						?>
							<div class="option_container_page">
								<input class="search_option_result option_create" type="submit" name="create" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Add</p>
						</div>
						
						<?php
						} ?>
					</div>
				</div>
				</form>

	


</div>


</div>
</div>
<style>
.textarea_container_label_form{
	height: 50px;
	font-size: 30px;
	color: white;
	width: 100%;
	background-size: 100% 100%;
	background-image: url('/image/cuadro-blanco1-914-488.png');
}

.textarea_text_form{
	width: 100%;
	height: 100px; 
	text-align: left;
	resize: none;
	font-size: 20px;
	padding-left: 20px; 
	padding-right: 20px;
}
</style>
<?php 
//include header template
require('layout/footer.php');
?>