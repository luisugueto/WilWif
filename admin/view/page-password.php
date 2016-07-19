<?php require('../includes/config.php');
require('../classes/db.php');

$db = new DB();

//if logged in redirect to members page
if(!$db->is_logged_in()){ header('Location: login.php'); } 

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
		$password = $_POST['password'];
		$sql = mysql_query("UPDATE members SET password = $password WHERE memberID = $id");
		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'It has changed the password', NOW())";
		$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			//redirect to index page
			header('Location: index.php?action=resetAccount');
			exit;
	}

}

	//define page title
$title = 'Cambiar Contraseña';

//include header template
require('layout/header.php');
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
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
		</div>
	</div>


</div>

<?php
//include header template
$actualpage = "Reset Password";
require('layout/footer.php');
?>
