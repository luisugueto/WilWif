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
		$error[] = 'Usuario muy corto.';
	}	
	
	elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) { 
      $error[] = 'El usuario tiene caracteres no validos.';
    } 
	
 	elseif(strlen($_POST['password']) < 3){
		$error[] = 'Contraseña muy corta.';
	}

	elseif($passwordConfirm != $password){
		$error[] = 'Las Contraseñas no coinciden.';
	}

	elseif($row==1){
		$error[] = 'Username ya utilizado.';
	}

	elseif($row1==1){
		$error[] = 'Email ya utilizado.';
	}

	else{
		$query_rol = mysql_query("SELECT * FROM rol WHERE code = '001'");
		$assoc_rol = mysql_fetch_assoc($query_rol);
		$stmt = mysql_query('INSERT INTO user (username,password,email, create_date, last_mod_date, security_question, status) VALUES ("'.$username.'", "'.$password.'", "'.$email.'", NOW(), NOW(),"Your pet name?", "Active" )');

		if($stmt == true)
		{
			echo "<script>
			alert('Usuario Registrado.');
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
	}
}

require('layout/header.php');
?>


<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				} ?>

<div id="content_containter">
	<div class="content_div_1">
		<div class="div_inline-block">
		<form action="" method="post">
		<table style="border-color: white; display: inline-block; " border="0px;">
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">User Name</p>
						<input type="text" name="username" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Email Name</p>
						<input type="text" name="email" id="email" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Password</p>
						<input type="password" name="password" id="password" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Retry-Password</p>
						<input type="password" name="passwordConfirm" id="passwordConfirm" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Wilwif Code</p>
						<input type="text" readonly name="code" id="passwordConfirm" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				
		</table>
			<br>
			<input type="submit" id="submit" name="submit" value="" style="background:url('/image/boton-aceptar2-50-50.png'); background-size: 60%; background-repeat: no-repeat; width: 120px; height: 120px; border: 0px">
			<p style="margin-top: -50px; margin-left: -40px; color:white">Accept</p>
			<button type="submit" onclick="history.back()" id="submit" value="" style="background:url('/image/boton-aceptar2-50-50.png'); background-size: 60%; background-repeat: no-repeat; width: 120px; height: 120px; border: 0px">
			<p style="margin-top: 50px; margin-left: -40px; color:white">Return</p>
		</form>
	</div>
	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>