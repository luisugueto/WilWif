<?php 
//process login form if submitted
if (isset($_POST['modify'])){
	
	if(!isset($_POST['email']) || empty($_POST['email']))
	{
		$error = 'Email is require.';
			
	}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$error = 'Email format is invalid.';
	}
		
	$email = $_POST['email'];
		
	$name = (isset($_POST['name']))? $_POST['name']: '';
	$lastname = (isset($_POST['lastname']))? $_POST['lastname']: '';
	$username = $_SESSION['username'];
		if(!isset($error))
		{	
			$user = ModifyAccountEmployee($username,$email,$name,$lastname);
			if (is_a($user, 'errorCodes')) {
				$errors = $user->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
		}
		
	
}else  if (isset($_POST['modifypass'])){
	
	if(!isset($_POST['password']) || empty($_POST['password']))
	{
		$error = 'Password is require.';
			
	}

	$username = $_SESSION['username'];
	$password	=$_POST['password'];
		if(!isset($error))
		{	
			$user = ChangePasswordEmployee($username,$password);
			if (is_a($user, 'errorCodes')) {
				$errors = $user->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else
			{
				$error = 'Passwords change successful.';
			}
		}
		

}

	$user = new userInfo($_SESSION['username']);
	if(isset($user->user_id))
	{
		$username = $user->user_username;
		$email = $user->user_email;
		$name = $user->user_name;
		$lastname = $user->user_lastname;
		$status = $user->user_status;
		$rol = $user->user_rol_slug;
		$rolcode = $user->user_rol_code;
	}else{
		die("User Does Not Exist");
	}


require('layout/header.php'); 
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png');">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/login/'>
			<p class="fontsize_3" style="margin-bottom: 0px;">back</p>
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



<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">

				<div class="row"  style="">

            <div class="col-xs-12 col-md-12" style="margin-bottom:30px; margin-top:20px">
				<img src="/image/logo-187-187.png" title="logo" width="187" height="187" >
			</div>
			</div>
				<div style="color:black">
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="text" name="username" class="label_text_input"  id="username" placeholder="Username" value="<?php if(isset($username)){ echo $username; } ?>" readonly>
						</div>	
					</div>	
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="text" name="email" class="label_text_input"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
						</div>	
					</div>	
					
					
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="text" name="name" class="label_text_input"  id="name"  placeholder="Name" value="<?php if(isset($name)){ echo $name; } ?>" >
						</div>	
					</div>
					
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="text" name="lastname" class="label_text_input"  id="lastname" placeholder="Lastname"  value="<?php if(isset($lastname)){ echo $lastname; } ?>" >
						</div>	
					</div>
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<p class="maxpl">
							<input type="password" name="password" class="label_text_input pass"  id="password"  placeholder="Password" value="" >
							<input class="fontsize_3" type="submit" name="modifypass" value="Change" style="border-width: 0px; padding-right: 0px; padding-left: 0px; background-color: transparent; color: white; width: 80px;">
							</p>
						</div>	
					</div>
					
					<div class="row" style="margin-bottom:100px;color:white; text-align: left;">
			
						<div class="col-xs-12 col-md-12">
							<p class="maxpl">
							<input  class="fontsize_4" type="submit" name="modify" value="Edit" style="border-width: 0px; padding-right: 0px; padding-left: 0px; background-color: transparent; color: white;">
							</p>
						</div>
					</div>
					
				</div>
				
				</form>
		
</div>

<style>

.maxpr{
	width:300px;
	margin:auto;
	text-align:right;
}

.maxpl{
	width:300px;
	margin:auto;
	text-align:left;
}
.label_text_input{
		width: 300px;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
		
	}
	
	.pass{
		width: 215px;
	}
	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
.label_text_input{
	width: 430px;
	}
	
	.maxpr{
	width:430px;
	margin:auto;
	text-align:right;
}

.pass{
	
	width:345px;
}	
.maxpl{
	width:430px;
}
}


	
</style>
<?php 
$actualpage = "Account";
//include header template
require('layout/footer.php');
?>