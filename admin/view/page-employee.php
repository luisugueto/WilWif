<?php 
//process login form if submitted
if (isset($_POST['modify'])){
	if(isset($_POST['username']) && !empty($_POST['username']))
	{
		
		$username = $_POST['username'];
		if(!isset($_POST['email']) || empty($_POST['email']))
		{
			$error = 'Email is require.';
			
		}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$error = 'Email format is invalid.';
		}
		
		$email = $_POST['email'];
		
		if(!isset($_POST['rolcode']) || empty($_POST['rolcode']))
		{
			$error = 'Rol is require.';
		}
		
		$query = "SELECT id FROM rol WHERE code = '".$_POST['rolcode']."' ";
		$sql = mysql_query($query);
		if($row = mysql_fetch_assoc($sql))
		{
			$rolcode = $row['id'];
		}else{
			$error = 'Rol dont exist.';
		}	
		
		$name = (isset($_POST['name']))? $_POST['name']: '';
		$lastname = (isset($_POST['lastname']))? $_POST['lastname']: '';
		
		if(!isset($error))
		{	
			$user = ModifyUser($username,$email,$name,$lastname,$rolcode,'','');
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
		}
		
	}else{
		$error = 'Username is require.';
	}
}else if (isset($_POST['block'])){
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
				header('Location: /employees/employees/');
			}
	
		
	}else{
		$error = 'Username is require.';
	}
}if (isset($_POST['create'])){
	
	if(isset($_POST['username']) && !empty($_POST['username']))
	{
		$query = "SELECT * FROM user WHERE username = '".$_POST['username']."' ";
		$sql = mysql_query($query);
		if($row = mysql_fetch_assoc($sql))
		{
			$error = 'Username already exist.';
		}
		$username = $_POST['username'];
		$password2 = CreatePassword();
		$password =  md5($password2);
		if(!isset($_POST['email']) || empty($_POST['email']))
		{
			$error = 'Email is require.';
			
		}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$error = 'Email format is invalid.';
		}
		
		
		$email = $_POST['email'];
		
		if(!isset($_POST['rolcode']) || empty($_POST['rolcode']))
		{
			$error = 'Rol is require.';
		}
		
		$query = "SELECT id FROM rol WHERE code = '".$_POST['rolcode']."' ";
		$sql = mysql_query($query);
		if($row = mysql_fetch_assoc($sql))
		{
			$rolcode = $row['id'];
		}else{
			$error = 'Rol dont exist.';
		}	
		
		$name = (isset($_POST['name']))? $_POST['name']: '';
		$lastname = (isset($_POST['lastname']))? $_POST['lastname']: '';
		
		if(!isset($error))
		{
			$user =  CreateUser($username,$password,$email,$name,$lastname,$rolcode,"","");
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
		}
		
	}else{
		$error = 'Username is require.';
	}
	

}else if(isset($_GET['employeeusername'])){
	$user = new userInfo($_GET['employeeusername']);
	if(isset($user->user_id))
	{
		$username = $user->user_username;
		$email = $user->user_email;
		$name = $user->user_name;
		$status = $user->user_status;
		$rol = $user->user_rol_slug;
		$rolcode = $user->user_rol_code;
	}else{
		die("User Does Not Exist");
	}
}

require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">EMPLOYEE</h2>
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
		
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="username" class="input_label_form">Username</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="username" class="input_text_form"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>" <?php if(isset($username)){ echo 'readonly'; } ?>>
							  </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="email" class="input_label_form">Email</label>
							  </div>
							  <div class="input_container_text_form">
								<input readonly type="text" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="name" class="input_label_form">Name</label>
							  </div>
							  <div class="input_container_text_form">
								<input readonly type="text" name="name" class="input_text_form"  id="name"   value="<?php if(isset($name)){ echo $name; } ?>" >
							  </div>
						 </div>
					</div>
					
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="item_title" class="input_label_form">Rol</label>
							  </div>
							  <div class="input_container_text_form">
								<select name="rolcode">
									<?php 
									if(isset($rolcode))
									{
									?>
										<option value="<?php echo $rolcode?>"><?php echo $rol?></option>
									<?php 
									}else
									{
									?>
										<option value=""></option>
									<?php
									}
									 $query = "select slug,code from rol";
									 $sql = mysql_query($query);
									 while($row = mysql_fetch_assoc($sql))
									{
									?>
										<option value="<?php  echo $row['code'];?>"><?php  echo $row['slug'];?></option>
									<?php
									}
									?>
								</select>
							 </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<input readonly type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($status)){ echo $status; } ?>" readonly>
							  </div>
						 </div>
					</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/employees/employees/">
								<input readonly class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php 
							if(isset($username))
							{
							?>	
							<div class="option_container_page">
								<input readonly class="search_option_result option_modify" type="submit" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Modify</p>
							</div>
							<div class="option_container_page">
								<input readonly class="search_option_result option_deleted" type="submit" name="deleted" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Deleted</p>
							</div>
							<?php
							if($status != 'Block')
							{
							?>
							<div class="option_container_page">
								<input readonly class="search_option_result option_block" type="submit" name="block" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Block</p>
							</div>
							<?php
							}else{
							?>
							<div class="option_container_page">
								<input readonly class="search_option_result option_unblock" type="submit" name="unblock" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Unblock</p>
							</div>
							<?php
							}
							
							}else
							{
							?>	
							<div class="option_container_page">
								<input readonly class="search_option_result option_create" type="submit" name="create" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Add</p>
							</div>
							<?php
							
							}
						?>
						
					</div>
				</div>
				</form>
		
</div>

<style>

.options_container_page{
	width: 780px;
	padding-top: 10px;
	padding-bottom: 10px;
	display: inline-block;
}
.option_container_page{
	float: left; margin-right: 20px;
}

.options_frame_page{
	clear: both;
	content: '';
	display: table;
	float: right;
}

.input_container_form{
	background-image: url("/image/barra-login-580-50.png");
	background-size: 100% 100%;
	background-repeat: no-repeat;
	height: 50px;
	color: white;
	 width: 534px;
}

.input_container_label_form{
	width: 166px;
	height: 50px;
	float: left;
	line-height: 50px;
	font-size: 30px;
	overflow:hidden;
	text-align:left;
	padding-left: 10px;
}

.input_container_text_form{
	float: left;
	width: 367px;
	height: 50px;
	line-height: 50px;
	overflow:hidden;
}

.input_container_text_form input{
	height: 42px;
	padding: 0px 20px;
	border-width: 0px;
	width: 363px;
	background-color: transparent;
	font-size: 20px;
	text-align:center;
}

.input_container_text_form select{
	height: 42px;
	padding: 0px 20px;
	border-width: 0px;
	width: 363px;
	background-color: transparent;
	font-size: 20px;
	text-align:center;
}

@media all and (max-width: 1024px)
{
	.content_chat_div_1{
		width: 500px;
	}
	
	.input_container_form{
		width: 400px;
	}
	
	.input_container_label_form{
		width: 125px;
		font-size: 20px;
	}
	
	.input_container_text_form{
		width: 273px;
	}
	
	.input_container_text_form input{
		width: 273px;
		padding-right: 10px; 
		padding-left: 10px;
		font-size: 16px;
		
	}
	
	.input_container_text_form select{
		width: 273px;
		padding-right: 10px; 
		padding-left: 10px;
		font-size: 16px;
		
	}

	.options_container_page{
		width: 500px;
	}
}


@media all and (max-width: 420px)
{
	.content_chat_div_1{
		width: 300px;
		padding-top: 15px;
		padding-bottom: 15px;
	}
	
	.input_container_form{
		width: 260px;
		height: 40px;
	}
	
	.input_container_label_form{
		width: 82px;
		padding-left: 5px;
		height: 40px;
		line-height: 40px;
		font-size: 14px;
	}
	
	.input_container_text_form{
		width: 177px;
		height: 40px;
		font-size: 10px;
	}
	
	.input_container_text_form input{
		padding-left: 3px;
		padding-right: 3px;
		width: 177px;
		height: 30px;
		line-height: 31px;
		font-size: 13px;
	}
	
	.input_container_text_form select{
		padding-left: 3px;
		padding-right: 3px;
		width: 177px;
		height: 30px;
		line-height: 31px;
		font-size: 13px;
	}
	
	.options_container_page{
		width: 280px;
	}
	
	.option_container_page{
		margin-right: 0px;
	}
	
	.content_chat_div_1{
		width: 300px;
		height: 300px;
		padding-top: 40px;
		padding-bottom: 30px;
	}
}
</style>
<?php 
//include header template
require('layout/footer.php');
?>