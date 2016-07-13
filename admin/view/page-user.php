<?php
require('layout/header.php');

if (isset($_POST['block'])){
	if(isset($_POST['username']) && !empty($_POST['username']))
	{
		
		$username = $_POST['username'];
		
		$user = BlockUser($username);
			if (is_a($user, 'errorCodes')) {
				$errors = $user->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
				$username = $user->user_username;
				$email = $user->user_email;
				$name = $user->user_name;
				$status = $user->user_status;
				$rol = $user->user_rol_slug;
				$rolcode = $user->user_rol_code;
			}
	
		
	}else{
		$error = 'Username is require.';
	}

}if (isset($_POST['unblock'])){
if(isset($_POST['username']) && !empty($_POST['username']))
	{
		
		$username = $_POST['username'];
		
		$user = UnblockUser($username);
			if (is_a($user, 'errorCodes')) {
				$errors = $user->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
				$username = $user->user_username;
				$email = $user->user_email;
				$name = $user->user_name;
				$status = $user->user_status;
				$rol = $user->user_rol_slug;
				$rolcode = $user->user_rol_code;
			}
	
		
	}else{
		$error = 'Username is require.';
	}
}if (isset($_POST['deleted'])){


if(isset($_POST['username']) && !empty($_POST['username']))
	{
		
		$username = $_POST['username'];
		
		$user = DeletedUser($username);
			if (is_a($user, 'errorCodes')) {
				$errors = $user->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
				header('Location: /users/users/');
			}
	
		
	}else{
		$error = 'Username is require.';
	}
}else if(isset($_GET['username'])){
	
	$user = new userInfo($_GET['username']);
	if(isset($user->user_id))
	{
		$username = $user->user_username;
		$email = $user->user_email;
		$name = $user->user_name;
		$status = $user->user_status;
		$rol = $user->user_rol_slug;
		$rolcode = $user->user_rol_code;
		$lastname = 	$user->user_lastname;
		$security_question = 	$user->user_security_question;
		$creationDate = $user->user_create_date;
		$modDate = $user->user_last_mod_date;
		$user_photo = $user->user_photo;
	}else{
		die("User Does Not Exist");
	}
}

if(isset($_GET['type']))
{
	$id = $_GET['id'];
	$type = $_GET['type'];
	if ($type == 'r') 
	{
		$query_block = mysql_query("UPDATE user SET status = 'Deleted' WHERE id = '".$id."'") or die("error");
 		header('Location: /users/');
	}
	elseif($type == 'b')
	{
		$query_block = mysql_query("UPDATE user SET status = 'Block' WHERE id = '".$id."'") or die("error");
		header('Location: /users/');
	}
	elseif($type == 'u')
	{
		$query_block = mysql_query("UPDATE user SET status = 'Unlock' WHERE id = '".$id."'") or die("error");
		header('Location: /users/');
	}

}

//$query = mysql_query("SELECT * FROM user WHERE id = '".$_POST['id']."'");
//$assoc = mysql_fetch_assoc($query);
?>

<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">User</h2>
		</div>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter">
<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">
	<div class="content_chat_div_1">
		<div  style="display: inline-block;">
			<div class="images_container">
						<div class="list_container">
						<ul id="list_images" class="list_images">
					
							<?php if($user_photo)
								{
								?>
									<li>
										<div style="background: transparent url('http://wilwif.local:86<?php echo $user_photo?>') no-repeat scroll 0% 0% / 100% 100%;"></div>
									</li>
								<?php
								
								}else{
									?>
									<div class="uploader_clasethumb" style="background: transparent url('http://wilwif.local:86/image/No_image_available_125x132.png') no-repeat scroll 0% 0% / 100% 100%;"></div>
									<?php
								}
								?>
						</ul>
						</div>
			</div>	
		</div>
			
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="username" class="input_label_form">Username</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="username" class="input_text_form"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>" <?php if(isset($username)){ echo 'readonly'; } ?> readonly>
							  </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="email" class="input_label_form">Email</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="name" class="input_label_form">Name</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="name" class="input_text_form"  id="name"   value="<?php if(isset($name)){ echo $name; } ?>" readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="item_title" class="input_label_form">Lastname</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="rolcode" class="input_text_form"  id="name"   value="<?php if(isset($lastname)){ echo $lastname; } ?>" readonly>
							   </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($status)){ echo $status; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Security Question?</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($security_question)){ echo $security_question; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Creation</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($creationDate)){ echo $creationDate; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Mod Date</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($modDate)){ echo $modDate; } ?>" readonly>
							  </div>
						 </div>
						</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/users/users/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php 
							if(isset($username))
							{
							?>	
							
							<div class="option_container_page">
								<input class="search_option_result option_deleted" type="submit" name="deleted" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Deleted</p>
							</div>
							<?php
							if($status != 'Block')
							{
							?>
							<div class="option_container_page">
								<input class="search_option_result option_block" type="submit" name="block" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Block</p>
							</div>
							<?php
							}else{
							?>
							<div class="option_container_page">
								<input class="search_option_result option_unblock" type="submit" name="unblock" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Unblock</p>
							</div>
							<?php
							}
							
							}
							?>	
							
							
						
					</div>
				</div>
				</form>



		</div>
	</div>
</div>
<style>
.content_chat_div_1{
	height:auto;
	padding-top: 90px;
	padding-bottom: 87px;
}
</style>


<style>

.list_container{
	overflow: hidden; 
	height: 120px;
	width: 120px;
}
.list_images {
	background-image: url('/image/No_image_available_125x132.png');
    background-size: 100% 100%;
	list-style: outside none none;
	margin: 0px;
	padding: 0px;
	position: relative;
	top: 0px; 
	bottom: 0px;
	width: 100%;
	height: 100%;
}
.list_images li {
	display:block;
	float:left;
	position:relative;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	background-color:white;
	width: 100%;
	height: 100%;
}
.list_images div {
	margin: 0px;
	width:100%;
	height:100%;
}


.images_container{
	float: left;
}

.images_holder{
	clear: both; 
	content: "";
	display: table;
	padding-left: 20px;

}

.images_control{
  position: relative;
  top: 75px;
  height: 30px;
  margin-top: -32px;
  z-index: 2;
  margin-left: -23px;
  width: 176px;
}


</style>
<?php 
//include header template
require('layout/footer.php');
?>