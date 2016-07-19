<?php
//process login form if submitted
if(isset($_POST['submit'])){
	
	$password = md5($_POST['password']);
	$passwordConfirm = md5($_POST['passwordConfirm']);
	$username = htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

 	$sql = "SELECT * FROM user WHERE username = '".$_POST['username']."' ";
 	$query = mysql_query($sql);
 	$row = mysql_num_rows($query);

 	$sql1 = "SELECT * FROM user WHERE email = '".$_POST['email']."' ";
 	$query1 = mysql_query($sql1);
 	$row1 = mysql_num_rows($query1);
	
	if(strlen($username) < 3){
		$error = 'Username to short.';
	}else if(strlen($_POST['password']) < 3){
		$error = 'Password to short.';
	}

	else if($passwordConfirm != $password){
		$error = 'mismatch password.';
	}

	else if($row==1){
		$error = 'Username already registered.';
	}

	else if($row1==1){
		$error = 'email already registered.';
	}else

	if(!isset($_POST['phone']) || empty($_POST['phone'])){
		$error = 'Phone number require.';
	}else if(!isset($_POST['email']) || empty($_POST['email'])){
		$error = 'Email require.';
	}else{
		$phone = $_POST['phone'];
		$wilwifcode = (isset($_POST['wilwifcode']))? $_POST['wilwifcode']:"";
		$query_rol = mysql_query("SELECT * FROM rol WHERE code = '001'");
		$assoc_rol = mysql_fetch_assoc($query_rol);
		$stmt = mysql_query('INSERT INTO user (username,password,email, create_date, last_mod_date, security_question, status, rol_id,wilwifcode,phonenumber) VALUES ("'.$username.'", "'.$password.'", "'.$email.'", NOW(), NOW(),"Your pet name?", "Active" ,"'.$assoc_rol['id'].'","'.$wilwifcode.'","'.$phone.'")');

		if($stmt == true)
		{
			echo "<script>
			alert('Username already registered.');
			</script>";
			if($db->login($username,$password)){ 
				header('Location: /');
				exit;
			}
		}
		elseif($stmt == false)
		{
			die("error");
		}
		die();
		$mensaje[] = "Registro Exitoso";
		
		$username = htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$password = md5($_POST['password']);	
		if (!ereg("^[a-zA-Z0-9\-_]{3,20}$", $username)) { 
		$error[] = 'El nombre de usuario tiene caracteres no validos';
		} else {
	
		if($db->login($username,$password)){ 
			$_SESSION['username'] = $username;
			header('Location: /account/');
			exit;
	
		} else {
			$error = 'Usuario o Password no ha sido activada.';
		}
	} 
	}
}

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

echo '<p class="bg-danger">'.$error.'</p>';
}
	
?>
<form  method="post" action="" autocomplete="off">

	
		<div class="row"  style="">

            <div class="col-xs-12" style="margin-bottom:10px;">
				<img src="/image/logo-187-187.png" title="logo" width="90" height="90" >
			</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
				<input type="text" name="username" id="username" placeholder="Username" class="label_text_input"  value="<?php if(isset($username)){ echo $username; } ?>" require>
			</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
			 <input type="text" name="email"  id="email" placeholder="Email" class="label_text_input"  value="<?php if(isset($email)){ echo $email; } ?>" require>
			</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
		<input type="text" name="phone" id="phone" class="label_text_input" placeholder="Phone Number"  value="" require>
		</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
		<input type="password" name="password" id="password" class="label_text_input" placeholder="Password"  value="" require>
		</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
		<input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm your Password" class="label_text_input"  value="" require>
		</div>
		</div>
		<div class="row"  style="">
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
		<input type="text" name="code" id="wilwifcode" class="label_text_input" placeholder="Wilwif-Code : xxx-xxx-xxx" value="<?php if(isset($_GET['wilwifcode'])){ echo $_GET['wilwifcode']; } ?>">
		</div>
		</div>
		<div class="row" >
			<div class="col-xs-1 col-md-4">
			
			</div>
			<div class="col-xs-10 col-md-4">
		<input  type="submit" name="submit" value="Sign Up"  style="background-color: transparent; color: rgb(0, 55, 123); border-width: 0px; font-size: 20px; cursor:pointer">
		</div>
		</div>


		
<script>
	$("#wilwifcode").keyup(function(){
    if($("#wilwifcode").val().length == 9){
        var my_val = $("#wilwifcode").val();
        $("#wilwifcode").val((my_val.substring(0, 3))+"-"+(my_val.substring(3, 6))+"-"+(my_val.substring(6, 9)));
    }
});
</script>

</form>
<div class="row" style="color:blue; text-align: center; ">
	
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png" >
		</P>
	</div>	
</div>
</div>
 
<style>

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
	


html{
	 background-image: none;
}

a{
	
		text-decoration:none;
		color:white;
	}
	
	a:hover{
	
		text-decoration:none;
		color:white;
		font-weight: bold;
	}
	

.row{
margin-right:0px;
}

#content{

min-height:366px;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

#content{

min-height:495px;
}
	
	
 }

/* Medium devices (desktops, 992px and up) */
@media (min-width: @screen-md-min) {
		#content{

	min-height:600px;
	}
 }

/* Large devices (large desktops, 1200px and up) */
@media (min-width: @screen-lg-min) { 
	
}

.botonera_button_principal{
	width:83px;
	height:129px;
	margin-bottom: -50px
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
.facebook_login ,.google_login ,.email_login{

	min-width:370px;
	max-width:370px;
	height: 54px;
	padding-left:20px;
}
.maxp{
	width:370px;
 }
 
 
 .row_margin_button{

margin-top:20px;
}
 
 .botonera_button_principal{
	width:111px;
	height:176px;
	margin-bottom: -50px;
 }
}

</style>
 <?php 
//include header template
require('layout/footer.php'); 
?>