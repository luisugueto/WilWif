<?php
//include config
require_once('../includes/config.php');
require_once('../classes/db.php');

$db = new DB();

//check if already logged in move to home page
#if( $db->is_logged_in() ){ header('Location: index.php'); } 
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id = '".$id."'";
$query = mysql_query($sql);
$query_assoc = mysql_fetch_assoc($query);


if(isset($_POST['submit'])){

	$modifcar = "UPDATE user SET last_mod_date = NOW(), blocked = NULL WHERE id = '".$id."'";
	$sql_modificar = mysql_query($modifcar);
	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'It has unlocked a user.', NOW())";
	$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
		//redirect to index page
	header('Location: /listadoUsuarios/');
	exit;
}

//define page title
$title = 'Login';

//include header template
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	    	<form role="form" method="post" action="" autocomplete="off">
				<h2>Unlock User</h2>
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
					}
				}
				?>
				<div class="form-group">
					<input readonly type="text" name="name" id="name" class="form-control input-lg" placeholder="Name" value="<?php echo $query_assoc['name']; ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input readonly type="text" name="lastName" id="lastName" class="form-control input-lg" placeholder="Last Name" value="<?php echo $query_assoc['lastname']; ?>" tabindex="2">
				</div>
				<div class="form-group">
					<input readonly type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?php echo $query_assoc['username']; ?>" tabindex="3">
				</div>
				<div class="form-group">
					<input readonly type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="<?php echo $query_assoc['email']; ?>" tabindex="4">
				</div>

				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Unlock" class="btn btn-primary btn-block btn-lg" tabindex="5" onclick="return confirmar()"></div>
				</div>
			</form>
		</div>
	</div>



</div>

<script>
function confirmar()
{
	if(confirm('¿Seguro que quiere bloquear a este usuario?'))
		return true;
	else
		return false;
}
</script>


<?php 
//include header template
require('layout/footer.php'); 
?>
