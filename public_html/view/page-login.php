<?php
//include config
require_once('../includes/config.php');
require_once('../classes/db.php');

$db = new DB();

//check if already logged in move to home page
#if( $db->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit']) &&	isset($_POST['username'])&&	isset($_POST['password'])){

	if(!empty($_POST['username']) || !empty($_POST['password']))
	{
	$username = $_POST['username'];//htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$password = md5($_POST['password']);	
	
	
		if($db->login($username,$password)){ 
			$_SESSION['username'] = $username;
			header('Location: /account');
			exit;
	
		} else {
			$error = 'Username or Password invalid.';
		}
	}else $error = 'Username and Password Require.';
}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

<div id="content">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
		<div class="row">	
			<div class="col-xs-3 col-md-2" >
				<a href='/'>
					<p>back</p>
				</a>
			</div>
			
			<div class="col-xs-6 col-md-8" >
				<p></p>
			</div>
		</div>
	</div>	
	<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post" action="">

		<div class="row"  style="">

            <div class="col-xs-12" style="margin-bottom:10px;">
				<img src="/image/logo-187-187.png" title="logo" width="90" height="90" >
			</div>
		</div>
		<div class="row"  style="">
			
			<div class="col-xs-12 col-md-12">
				<input type="text" name="username" placeholder="Username/Email" class="username_login"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>">
			</div>
		</div>
		<div class="row"  style="">
			
			<div class="col-xs-12 col-md-12">
				<input type="password" name="password" placeholder="Password" class="password_login"  id="password"   value="" >
			</div>
		</div>
		<div class="row" style="color:blue; text-align: right;">
			
			<div class="col-xs-12 col-md-12">
				<a href="/reset/">
					<p class="maxpr"style="color:blue">Forgot your password?</p>
				</a>
			</div>
		</div>
			
				
				
				<div class="row">
	
	<div class="col-xs-12 col-md-12">
		<input type="button" class="facebook_login" value="Login with Facebook">
	</div>
	
</div>

<div class="row">
	<div class="col-xs-0 col-md-0">
	</div>
	<div class="col-xs-12 col-md-12">
		<input type="button" class="google_login" value="Login with Google">
	</div>
</div>
<div class="row" style="color:blue; ">
	<div class="col-xs-0 col-md-0">
	</div>
	<div class="col-xs-12 col-md-12">
		<p class="maxpr" >
		Remember me<input type='checkbox' name='agree' value='Agree' id="agree" /><br>
		</P>
	</div>
</div>

	<div class="row div_input_principal"  style="color:blue; text-align: center; ">
	
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<input type="submit" value="" class="botonera_button_principal" type="submit" name="submit">
			
		</P>
	</div>	
</div>
</form>
	

</div>

<style>

.div_input_principal{
margin-bottom: -50px;
 margin-top: 50px;
}
.botonera_button_principal{
 
background-image: url("/image/logo-botonera-111-x-173.png");
background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;

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
 .facebook_login{
	width: 192px;
	background-image: url("/image/Facebook-Label-370-x-54.png");
	background-size: 100% 100%;
	height: 30px;
	border-width: 0px;
	margin-top:50px;
	min-width:186px;
	max-width:186px;
	color:white;
	padding-left:20px;
 }
 
 .google_login{
	width: 100%;
	background-image: url("/image/Google-Label-370-x-54.png");
	background-size: 100% 100%;
	height: 30px;
	border-width: 0px;
	margin-top:10px;
	margin-bottom:10px;
	min-width:192px;
	max-width:192px;
	padding-left:20px;
}
 
 .email_login{
	width: 100%;
	background-image: url("/image/SING-UP-REGISTER-192-X-30-Mail.png");
	background-size:100% 100%;
	height: 30px;
	border-width: 0px;
	margin-top:10px;
	min-width:192px;
	max-width:192px;
	margin-bottom:10px;
	color:white;
	padding-left:20px;
 }


 .maxp{
	width:270px;
	margin: auto;
	text-align:left
 }
 
 maxpm{
	width:230px;
	margin: auto;
	text-align:center
 }
 
 .row_margin_button{

margin-top:80px;
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

 <?php 
//include header template
require('layout/footer.php'); 
?>