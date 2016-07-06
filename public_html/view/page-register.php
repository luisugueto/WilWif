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
		$error[] = 'Short User.';
	}	
	
	elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) { 
      $error[] = 'The user has invalid characters.';
    } 
	
	elseif(strlen($name) < 3){
		$error[] = 'Short Name..';
	}
	
	elseif (!preg_match('/^[a-zA-Z0-9 ]+$/', $name)) { 
      $error[] = 'The name has invalid characters.';
    } 

 	elseif(strlen($_POST['password']) < 3){
		$error[] = 'Short Password.';
	}

	elseif($passwordConfirm != $password){
		$error[] = 'Passwords do not match.';
	}

	elseif($row==1){
		$error[] = 'Username already used.';
	}

	elseif($row1==1){
		$error[] = 'Email already used.';
	}

	else{
	 	
		$stmt = mysql_query('INSERT INTO user (name,username,password,email) VALUES ("'.$name.'","'.$username.'", "'.$password.'", "'.$email.'")');
		echo "<script>
			alert('Registered user.');
		</script>";
		$mensaje[] = "Successful registration.";
	}
}

require('layout/header.php');
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Register</h2>
				<p>Already a member? <a href='/login/'>Enter</a></p>
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
<div class="contenedorLogin" style="padding-bottom: 20px;">
	<table style="margin-left: 50px; position:relative; top: -20px;">
		<tr>
			<th><p align="right" style="color: white; margin-top: 10px;">Name </p></th>
			<td>		
				<input style="margin-top: 10px" type="text" name="name" id="name" class="form-control input-lg" placeholder="Name" value="<?php if(isset($error)){ echo $name; } ?>" required tabindex="1">
			</td>
		</tr>
		<tr>
			<th><p align="right" style="color: white; margin-top: 10px;">Username </p></th>
			<td>		
				<input style="margin-top: 10px" type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" value="<?php if(isset($error)){ echo $username; } ?>" required tabindex="2">
			</td>
		</tr>
		<tr>
			<th><p align="right" style="color: white; margin-top: 10px;">Email </p></th>
			<td>		
				<input style="margin-top: 10px" type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="<?php if(isset($error)){ echo $email; } ?>" required tabindex="3">
			</td>
		</tr>
		<tr>
			<th><p align="right" style="color: white; margin-top: 10px;">Password </p></th>
			<td>		
				<input style="margin-top: 10px" type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required tabindex="4">
			</td>
		</tr>
		<tr>
			<th><p align="right" style="color: white; margin-top: 10px;">Repeat Password </p></th>
			<td>		
				<input style="margin-top: 10px" type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Repeat Password" required tabindex="5">
			</td>
		</tr>
		<input class="submit" style="top: 330px; margin-left: 30px;" type="submit" name="submit" value="" tabindex="6">
	</table>
</div>
			</form>
		</div>
	</div>

</div>

<?php
//include header template
require('layout/footer.php');
?>