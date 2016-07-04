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
$query_assoc = mysql_fetch_assoc($query) or die(mysql_error());


if(isset($_POST['submit'])){
		$mensaje = $_POST['message'];

		$history = "INSERT INTO notifications (id_user, message, status,create_date) VALUES('".$_SESSION['id']."', '".$mensaje."', 'Unread',NOW())";
		$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			//redirect to index page
			header('Location: /users/');
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
				<h2>Add Notification</h2>
				<hr>
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				?>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">User</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="label" name="username" id="username" class="form-control input-lg" value="<?php echo $query_assoc['username']; ?>" tabindex="1" readonly>
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Message</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
								<textarea class="form-control" rows="4" id="message" name="message" required></textarea>
								</div>
							</div>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Send" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				</div>
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
