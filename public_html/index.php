<?php require('../includes/config.php');

require('../classes/db.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

 	$sql = "SELECT * FROM members WHERE username = '".$_POST['username']."' ";
 	$query = mysql_query($sql);
 	$row = mysql_num_rows($query);

 	$sql1 = "SELECT * FROM members WHERE email = '".$_POST['email']."' ";
 	$query1 = mysql_query($sql1);
 	$row1 = mysql_num_rows($query1);

 	if(strlen($_POST['password']) < 3){
		$error[] = 'Contraseña muy corta.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirmar Contraseña muy corta.';
	}

	if($row==1){
		$error[] = 'Username ya utilizado.';
	}

	if($row1==1){
		$error[] = 'Email ya utilizado.';
	}

	else{
	 	$name = $_POST['name'];
	 	$password = $_POST['password'];
	 	$username = $_POST['username'];
	 	$email = $_POST['email'];
	 	
		$stmt = mysql_query('INSERT INTO members (name,username,password,email) VALUES ("'.$name.'","'.$username.'", "'.$password.'", "'.$email.'")');
		echo "<script>
			alert('Usuario Registrado.');
		</script>";
		$mensaje[] = "Registro Exitoso";
	}
}


//define page title
$title = 'Lost Object';

//include header template
require('layout/header.php');
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Por favor registrese</h2>
				<p>Ya eres miembro? <a href='login.php'>Entrar</a></p>
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
					<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Nombre" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" required tabindex="1">
				</div>
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nombre de Usuario" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" required tabindex="2">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Correo" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" required tabindex="3">
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

<?php
//include header template
require('layout/footer.php');
?>
