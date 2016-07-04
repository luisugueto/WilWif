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

 	$sql1 = "SELECT * FROM user WHERE username = '".$_POST['username']."' ";
 	$query1 = mysql_query($sql1);
 	$row1 = mysql_num_rows($query1);

 	$sql2 = "SELECT * FROM user WHERE email = '".$_POST['email']."' ";
 	$query2 = mysql_query($sql2);
 	$row2 = mysql_num_rows($query2);
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
	
	if($row1==1 && ($_POST['username'] != $query_assoc['username'])){
		$error[] = 'Username ya utilizado.';
	}

	if($row2==1 && ($query_assoc['email'] != $_POST['email'])){
		$error[] = 'Email ya utilizado.';
	}

	//if no errors have been created carry on
	if(!isset($error)) {
		$password = $_POST['password'];
		$email = $_POST['email'];
		$name = $_POST['name'];
		$lastname = $_POST['lastName'];
		$username = $_POST['username'];
		
		$modifcar = "UPDATE user SET last_mod_date = NOW(), password = '".$password."', email = '".$email."', name = '".$name."', lastname = '".$lastname."', username = '".$username."' WHERE id = '".$id."'";
		$sql_modificar = mysql_query($modifcar);

		$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'It has changed a user.', NOW())";
		$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			//redirect to index page
			header('Location: /users/');
			exit;
	}

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
				<h2>Edit User</h2>
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
					<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Name" value="<?php echo $query_assoc['name']; ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="text" name="lastName" id="lastName" class="form-control input-lg" placeholder="Last Name" value="<?php echo $query_assoc['lastname']; ?>" tabindex="2">
				</div>
				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?php echo $query_assoc['username']; ?>" tabindex="3">
				</div>
				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="4">
				</div>
				<div class="form-group">
					<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirmar Contraseña" tabindex="5">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="<?php echo $query_assoc['email']; ?>" tabindex="6">
				</div>

				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Edit" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				</div>
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
