<?php 
//process login form if submitted
if(isset($_POST['submit'])){

 	$sql = "SELECT * FROM user WHERE username = '".$_POST['username']."' ";
 	$query = mysql_query($sql);
 	$row = mysql_num_rows($query);

 	$sql1 = "SELECT * FROM user WHERE email = '".$_POST['email']."' ";
 	$query1 = mysql_query($sql1);
 	$row1 = mysql_num_rows($query1);

 	if(strlen($_POST['password']) < 3){
		$error[] = 'Password too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm Password short.';
	}

	if($row==1){
		$error[] = 'Username already used.';
	}

	if($row1==1){
		$error[] = 'Email already used.';
	}

	else{
	 	$name = $_POST['name'];
	 	$apellido = $_POST['apellido'];
	 	$password = $_POST['password'];
	 	$username = $_POST['username'];
	 	$email = $_POST['email'];
	 	
		$stmt = mysql_query('INSERT INTO user (name,lastname,username,password,email, rol_id, create_date) VALUES ("'.$name.'","'.$apellido.'" ,"'.$username.'", "'.$password.'", "'.$email.'", 2, NOW())');
		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'He flew am employee.', NOW())";
		$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
		echo "<script>
			alert('Registered user.');
		</script>";
		$mensaje[] = "Successful registration";
	}
}
require('layout/header.php'); 
?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-empleado-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;">EMPLOYEE</h1>
		</div>
	</div>
</div>
	<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
		
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Nuevo Empleado</h2>
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
					<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Name" value="<?php if(isset($error)){ echo $_POST['name']; } ?>" required tabindex="1">
				</div>
				<div class="form-group">
					<input type="text" name="apellido" id="apellido" class="form-control input-lg" placeholder="Last Name" value="<?php if(isset($error)){ echo $_POST['apellido']; } ?>" required tabindex="1">
				</div>
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" required tabindex="2">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" required tabindex="3">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required tabindex="4">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Repeat Password" required tabindex="5">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" required tabindex="6"></div>
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