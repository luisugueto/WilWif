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
	if (!ereg("^[a-zA-Z0-9\-_]{3,20}$", $username)) { 
      $error[] = 'El nombre de usuario tiene caracteres no validos';
    } else {
	
		if($db->login($username,$password)){ 
			$_SESSION['username'] = $username;
			header('Location: /');
			exit;
	
		} else {
			$error[] = 'Usuario o Password no ha sido activada.';
		}
	}
}//end if submit

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Por favor Ingrese</h2>
				<p><a href='./'>Ir a pagina de inicio</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Su cuenta está activa ahora se puede iniciar sesión.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Por favor, compruebe su bandeja de entrada para un enlace de restablecimiento.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Contraseña cambiado, ahora puede iniciar sesión.</h2>";
							break;
					}

				}

				
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $username; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9">
						 <a href='reset.php'>Perdiste tu contraseña?</a>
					</div>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Entrar" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
