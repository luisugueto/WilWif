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
	 	$apellido = $_POST['lastname'];
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
<div class="header_div_1">
	<div class="header_div_2">
		<div class="header_div_3 header_div_home">
			<h1 class="header_title_1">EMPLOYEE</h1>
		</div>
	</div>
</div>
<div id="content_containter">
	<div class="content_div_1">
		<div class="div_inline-block">
			<div class="images_holder" style="margin-left: 100px">
</div>
<form action="" method="post">
	<table style="border-color: white; display: inline-block; " border="0px;">
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">User Name</p>
						<input type="text" name="username" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Email</p>
						<input type="text" name="email" id="email" style=" text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Name</p>
						<input type="text" name="name" id="name" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Last Name</p>
						<input type="text" name="lastname" id="lastname" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 13px;">Password</p>
						<input type="password" name="password" id="password" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr>
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 5px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 5px;">Repeat Password</p>
						<input type="password" name="passwordConfirm" id="passwordConfirm" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
			</table>
			<br>
				<input class="btn btn-primary" type="submit" id="submit" name="submit" value="" style="background:url('/image/boton-crear-40-40.png'); width: 45px; height: 45px; border: 0px">
				<p style="color:white; margin-top: -10px">Add</p>
		</form>
			
		</div>
	</div>
		</div>

		</div>
	</div>
</div>
<?php 
//include header template
require('layout/footer.php');
?>