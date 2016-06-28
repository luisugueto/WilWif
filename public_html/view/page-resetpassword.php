<?php 

//if logged in redirect to members page

// $stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
// $stmt->execute(array(':token' => $_GET['key']));
// $row = $stmt->fetch(PDO::FETCH_ASSOC);

// //if no token from db then kill the page
// if(empty($row['resetToken'])){
// 	$stop = 'Elemento inválido proporcionado, por favor utilice el enlace proporcionado en el correo electrónico de restablecimiento.';
// } elseif($row['resetComplete'] == 'Yes') {
// 	$stop = 'Tu contraseña ha sido cambiada!';
//}

//if form has been submitted process it
if(isset($_POST['submit'])){
	//basic validation
	if(strlen($_POST['password']) < 3){
		$error[] = 'Contraseña muy corta.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirmar Contraseña muy corta.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Las contraseñas no son iguales';
	}

	//if no errors have been created carry on
	if(!isset($error)){

		$sql = "UPDATE user SET password = '".$_POST['password']."' WHERE id = '".$_SESSION['id']."'";
		$query = mysql_query($sql);
		header('Location: ./action=cambiada');
	}

}

//define page title
$title = 'Reset Account';

//include header template
require('layout/header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">


	    	<?php if(isset($stop)){

	    		echo "<p class='bg-danger'>$stop</p>";

	    	} else { ?>

				<form role="form" method="post" action="" autocomplete="off">
					<h2>Cambiar Contraseña</h2>
					<hr>

					<?php
					//check for any errors
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="bg-danger">'.$error.'</p>';
						}
					}

					//check the action
					switch (isset($_GET['action'])) {
						case 'cambiada':
							echo "<h2 class='bg-success'>Su contraseña ha sido cambiada.</h2>";
							break;
					}
					?>

					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="1">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirmar Contraseña" tabindex="2">
							</div>
						</div>
					</div>
					
					<hr>
					<div class="row">
						<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Cambiar Contraseña" class="btn btn-primary btn-block btn-lg" tabindex="3"></div>
					</div>
				</form>

			<?php } ?>
		</div>
	</div>


</div>

<?php 
//include header template
require('layout/footer.php'); 
?>