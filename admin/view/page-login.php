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
      $error[] = 'Error.';
    } else {
	
		if($db->loginBackOffice($username,$password)){ 
			$_SESSION['username'] = $username;
			$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'You are logged.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			header('Location: /');
			exit;
	
		} else {
			$error[] = 'Error.';
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
		<table style="border-color: white; display: inline-block; " border="0px;">
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 0px; color: white; font-size: 18px; margin-top: 10px; margin-right:-5px">User Name</p>
						<input type="text" name="username" id="username" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				<tr >
					<td style="float: right; background-image: url('/image/barra-info-646-54.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
						<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 18px; margin-top: 10px;">Password</p>
						<input type="password" name="password" id="password" style="text-align: center; border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
					</td>
				</tr>
				
		</table>
			<br>
			<button type="submit" id="submit" name="submit" value="" style="background:url('/image/boton-aceptar2-50-50.png'); background-size: 60%; background-repeat: no-repeat; width: 120px; height: 120px; border: 0px">
			<p style="margin-top: 50px; margin-left: -40px; color:white">Accept</p>
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