<?php
//include config
require_once('../includes/config.php');
require_once('../classes/db.php');

$db = new DB();

//check if already logged in move to home page
#if( $db->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){
	$username = htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$password = md5($_POST['password']);	
	
	
		if($db->loginBackOffice($username,$password)){ 
			$_SESSION['username'] = $username;
			$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'You are logged.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			header('Location: /');
			exit;
	
		} else {
			$error = 'Username or password does not exist';
		}
	
}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>
<form method="post" action="" autocomplete="off">
<div id="content">
<div>
	<div class="row">	
	<div class="col-xs-3 col-md-2" >
	
	<p></p>
	</div>
	
	<div class="col-xs-6 col-md-8" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-2" >
	
	</div>
	</div>
</div>	
	<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>

				
						<div class="row"  style="">

            <div class="col-xs-12" style="margin-bottom:60px; margin-top:60px">
				<img src="/image/logo-187-187.png" title="logo" width="187" height="187" >
			</div>
			</div>
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
							<input type="text" name="username" class="username_login"  id="username" placeholder="Username" value="<?php if(isset($username)){ echo $username; } ?>">
						</div>	 
					</div>	
					<div class="row"> 
						<div class="col-xs-12 col-md-12">
						<input type="password" name="password" class="password_login"  id="password" placeholder="Password"  value="<?php if(isset($email)){ echo $email; } ?>" >
						</div>
					</div>
				<div class="row" style="color:blue; text-align: right;margin-bottom:60px;">
			
					<div class="col-xs-12 col-md-12">
						<a href="/reset/">
							<p class="maxpr"style="color:white">Forgot your password?</p>
						</a>
					</div>
				</div>
							
			
	
		
</div>		
	
<style>

.submit_login{
	color:white;
	background-color: transparent;
	border-width: 0px;

}
.label_text_input{
		width: 100%;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
	}
.maxpr{
	width:186px;
	margin:auto;
	text-align:right;
}

.username_login{
		width: 186px;
		background-image: url("/image/Usuario.png-364-x-53.png");
		background-size: 100% 100%;
		height: 33px;
		border-width: 0px;
		min-width:186px;
		max-width:186px;
		padding-left:25px;
		background-repeat:no-repeat;
	}
	
	.password_login{
		width: 192px;
		background-image: url("/image/Lock-364-x-53.png");
		background-size: 100% 100%;
		height: 33px;
		border-width: 0px;
		margin-top:2px;
		min-width:186px;
		max-width:186px;
		padding-left:25px;
	}
	
	
	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {


.maxpl{
	width:370px;
}
.facebook_login ,.google_login ,.email_login,.username_login,.password_login{

	min-width:370px;
	max-width:370px;
	height: 54px;
	padding-left:20px;
}
.username_login,.password_login{
	padding-left:60px;
}
.maxpr{
	width:370px;
 }
 
 
 .row_margin_button{

margin-top:20px;
}
 
 .botonera_button_principal{
	width:111px;
	height:176px;
	
 }
 
 
}
</style>


	<footer style="background-image: url('/image/botonera-sola-1024-x-66.png'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:66px;">
	<div class="row">
				<div class="col-xs-12 col-md-12">
					<input class="submit_login fontsize_2" type="submit" name="submit" value="Login">
				</div>
			</div>
	</footer>
 

</form>
</body>
</html>