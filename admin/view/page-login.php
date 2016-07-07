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
	
		if($db->loginBackOffice($username,$password)){ 
			$_SESSION['username'] = $username;
			$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'You are logged.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
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
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-home-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 270px; font-family: arial,rial;">LOGIN</h1>
		</div>
		<form style="height: 0px; float: right;">
			<input type="text" name="s" value="" style="float: right; border-width: 0px; margin-top: 30px; background-image: url('	/image/barra-generica-478-47.png'); background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 70px; padding-left: 90px; width: 386px; height: 51px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<?php if( !$user->is_logged_in() ){ ?>

			<form role="form" method="post" action="" autocomplete="off">
				<h2>Por favor Ingrese</h2>
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
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Entrar" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
<?php } ?>
		</div>
	</div>



</div>

</div>
</div>

<?php 
//include header template
require('layout/footer.php');
?>