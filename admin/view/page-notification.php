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


<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png');">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/notifications/'>
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

<div id="content" >
	<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">
				<div style="color:black">
					<div class="row"> 
						<div class="col-xs-12 col-md-12 fontsize_4">
							<div>
								<input type="text" name="username" class="label_text_input"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>" readonly>
							</div>
						</div>
					</div>	
					<div class="row"> 
						<div class="col-xs-12 col-md-12 fontsize_4">
							<div>
								<input type="text" name="status" class="label_text_input"  id="status"   value="<?php if(isset($status)){ echo $status; } ?>"  readonly>
							</div>
						</div>
					</div>	
					<div class="row"> 
						<div class="col-xs-12 col-md-12 fontsize_4">
							<div>
								<input type="text" name="creation_date" class="label_text_input"  id="creation_date"   value="<?php if(isset($create_date)){ echo $create_date; } ?>"require readonly>
							</div>
						</div>
					</div>	
					<div class="row"> 
						<div class="col-xs-12 col-md-12 fontsize_4">
							<div>
								<textarea maxlength="200" type="text" style="resize:none;height: 250px;"name="message" class="label_text_input"  id="message" <?php if(isset($message)){ echo 'readonly'; } ?>><?php if(isset($message)){ echo $message; } ?></textarea>
							</div>
						</div>
					</div>
					
				</div>
				<?php if(!isset($_GET['notification_id'])){ 
						?>
				<div class="row"> 
					<div class="col-xs-12 col-md-12 fontsize_4">
						<input type="submit" name="create" value="Add">
					</div>
				</div>
				<?php
						} ?>
					
				</form>

	


</div>
<style>

.label_text_input{
		width: 300px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
		
	}
	
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
$actualpage = "Notifications";
require('layout/footer.php');
?>