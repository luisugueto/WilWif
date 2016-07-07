<?php
//process login form if submitted
if(isset($_POST['submit'])){
	
	$name = htmlentities($_POST['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
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
	
	elseif(strlen($name) < 3){
		$error[] = 'Nombre muy corto.';
	}
	
	elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $name)) { 
      $error[] = 'El nombre tiene caracteres no validos.';
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
	 	
		$stmt = mysql_query('INSERT INTO user (name,username,password,email) VALUES ("'.$name.'","'.$username.'", "'.$password.'", "'.$email.'")');
		echo "<script>
			alert('Usuario Registrado.');
		</script>";
		$mensaje[] = "Registro Exitoso";
	}
}

require('layout/header.php');
?>


<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form style="height: 0px; float: right;">
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="float: right; border-width: 0px; margin-top: 10px; background-image: url('	/image/barra-generica-478-47.png'); background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 70px; padding-left: 90px; width: 386px; height: 51px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	
	

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Por favor registrese</h2>
				<p>Ya eres miembro? <a href='/login/'>Entrar</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($mensaje)){
					foreach($mensaje as $mensaje){
						echo "<h2 class='bg-success'>".$mensaje."</h2>";
					}
				}
				?>
				<div class="form-group">
					<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Nombre" value="<?php if(isset($error)){ echo $name; } ?>" required tabindex="1">
				</div>
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nombre de Usuario" value="<?php if(isset($error)){ echo $username; } ?>" required tabindex="2">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Correo" value="<?php if(isset($error)){ echo $email; } ?>" required tabindex="3">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" required tabindex="4">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirmar Contraseña" required tabindex="5">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Registrar" class="btn btn-primary btn-block btn-lg" required tabindex="6"></div>
				</div>
			</form>
		</div>
	</div>

</div>

	</div>
</div>
<?php
//include header template
require('layout/footer.php');
?>