<?php
require('layout/header.php');


if($user->is_logged_in() )
{
	$query = "SELECT * FROM user WHERE id = '".$_SESSION['id']."'";
	$sql = mysql_query($query);
	$assoc = mysql_fetch_assoc($sql);


	if (isset($_POST['submit'])) {

		$password = md5($_POST['password']);
		$passwordConfirm = md5($_POST['retrypassword']);
		$username = htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


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

		else{

			$username = $_POST['username'];
			$name = $_POST['name'];
			$lastname = $_POST['lastname'];
			$security_question = $_POST['question'];
			$security_answer = $_POST['answer'];

			$query_update = mysql_query("UPDATE user SET password = '".$password."', email = '".$email."', name = '".$name."', lastname = '".$lastname."', security_answer = '".$security_answer."', security_question = '".$security_question."',  last_mod_date = NOW() WHERE id = '".$_SESSION['id']."'") or die(mysql_error());
			header('Location: /account/');
		}
	}
	
}

?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form method="get" action="/" style="background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<?php if( $user->is_logged_in() ){ ?>

			<form role="form" method="post" action="" autocomplete="off">
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}				
				?>
				<div id="content_containter">
	<div class="content_div_1">
		<div class="div_inline-block">
		<form action="" method="post">
		<table style="border-color: white; display: inline-block; " border="0px;">
				<tr >
				<th>User Name</th>

					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input readonly value="<?php echo $assoc['username']; ?>" type="text" name="username" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Status</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input readonly value="<?php echo $assoc['status']; ?>" type="text" name="status" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Email</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input value="<?php echo $assoc['email']; ?>" type="text" name="email" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Name</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input value="<?php echo $assoc['name']; ?>" type="text" name="name" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Last Name</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input value="<?php echo $assoc['lastname']; ?>" type="text" name="lastname" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Security Question</th>
					<td>
					<select id="question" name="question">
							<option value="" selected>- Select -</option>
							<?php 
							$query_answers = mysql_query("SELECT * FROM security_question");
							while ($assoc = mysql_fetch_assoc($query_answers)) { ?>
								<option value="<?php echo $assoc['label']; ?>"><?php echo $assoc['label']; ?></option>
							<?php } ?>

						</select>
					</td>
				</tr>
				<tr >
				<th>Security Answer</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input value="<?php echo $assoc['security_answer']; ?>" type="text" name="answer" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Password</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input type="password" name="password" id="password" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
				<th>Confirm Password</th>
					<td style="background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<input type="text" name="retrypassword" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				
		</table>
			<br>
			<button type="submit" id="submit" name="submit" value="" style="background:url('/image/boton-aceptar2-50-50.png'); background-size: 60%; background-repeat: no-repeat; width: 120px; height: 120px; border: 0px">
			<button type="button" onclick="window.location='/account/'" style="background:url('/image/boton-nuevouser-70-70.png'); background-size: 60%; background-repeat: no-repeat; width: 120px; height: 120px; border: 0px">
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