<?php 
//process login form if submitted
 if (isset($_POST['modifypass'])){
	
	if(!isset($_POST['password']) || empty($_POST['password']))
	{
		$error = 'Password is require.';
			
	}

	if(!isset($_POST['retrypassword']) || empty($_POST['retrypassword']))
	{
		$error = 'Retry-Password is require.';
			
	}
	
	if($_POST['password']!=$_POST['retrypassword'])
	{
		$error = 'Passwords does not match.';
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
		<a href='/account/'>
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


<div id="content_containter">
<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">

				<div style="color:blue">
					
					<div class="row" style="margin-top:100px"> 
						<div class="col-xs-12 col-md-12">
							<input type="password" name="password" class="label_text_input"  id="password"  placeholder="Password" value="" >
						</div>	
					</div>
					
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="password" name="retrypassword" class="label_text_input"  id="retrypassword"  placeholder="Confirm Password" value="" >
						</div>	
					</div>
					
				<div class="row" style="margin-bottom:100px"> 
						<div class="col-xs-12 col-md-12">
						<p class="maxpr fontsize_4">
							<input  type="submit" name="modifypass" value="Edit" style="border-width: 0px; padding-right: 0px; padding-left: 0px; background-color: transparent; color: white;">
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
}	
	
</style>
<?php 
$actualpage = "Password";
//include header template
require('layout/footer.php');
?>