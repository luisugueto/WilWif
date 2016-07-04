<?php
require('layout/header.php');

$code = $_POST['code'];
$type = $_POST['tipo'];
$query = "SELECT * FROM item WHERE id = '".$code."'";
$sql = mysql_query($query);
$assoc = mysql_fetch_assoc($sql);
if($user->is_logged_in() )
{
	if(isset($_POST['guardar']))
	{
		if ($type == 's') 
		{
			$code_item = $_POST['code'];
			$code_submit = "";
			$code_submit = date("Y").'-'.date('m').date('d').'-';
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			for ($i = 0; $i < 8; $i++) 
			{
				$code_submit = $code_submit.$characters[rand(0, strlen($characters))];
				if($i == 3)
				{
					$code_submit = $code_submit.'-';
				}
			}
			$status = $_POST['status'];
			$message = $_POST['item_message'];
			$title = $_POST['item_title'];
			$address = $_POST['item_address'];
			$user_send = $_SESSION['id'];
			$user_recive = $_POST['id_user'];
			$id_item = $_POST['id'];

			$query_item = "UPDATE item SET status = 'Deleted' WHERE id = $id_item";
		  	$item = mysql_query($query_item);
		  	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Send Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			$sql_send = "INSERT INTO submit (code, message, status, title, address, id_user_send, id_user_recive, id_item, create_date) VALUES ('".$code_submit."','".$message."','".$status."','".$title."','".$address."','".$user_send."','".$user_recive."','".$id_item."', NOW())";
			$query_send = mysql_query($sql_send) or die( mysql_error());
			header('Location: /');
		}
		elseif($type == 'r')
		{
			$code_item = $_POST['code'];
			$code_submit = date("Y").'-'.date('m').date('d').'-';
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			for ($i = 0; $i < 8; $i++) 
			{
				$code_submit = $code_submit.$characters[rand(0, strlen($characters))];
				if($i == 3)
				{
					$code_submit = $code_submit.'-';
				}
			}
			$status = $_POST['status'];
			$message = $_POST['item_message'];
			$title = $_POST['item_title'];
			$address = $_POST['item_address'];
			$user_send = $_SESSION['id'];
			$user_recive = $_POST['id_user'];
			$id_item = $_POST['id'];
			$query_item = "UPDATE item SET status = 'Deleted' WHERE id = $id_item";
		  	$item = mysql_query($query_item);
		  	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Send Item.', NOW())";
			$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
			$sql_received = "INSERT INTO `order` (`code`, `id_item`, `status`, `message`, `title`, `address`, `id_user_send`, `id_user_recived`, `create_date`, `last_mod_date`) 
			VALUES ('".$code_submit."', '".$id_item."', '".$status."', '".$message."', '".$title."', '".$address."', '".$user_send."', '".$user_recive."', NOW(), NOW())";
			$query_received = mysql_query($sql_received) or die(mysql_error());
			header('Location: /');
		}
	}
}

?>

<div class="container">

	<div class="row">

	    <div class="table-responsive">
				<h2>Item</h2>
				<hr>
			<form action="" method="POST">
			<?php
			if($type == 's') {  ?>
				<input type="hidden" name="tipo" id="tipo" value="s">
			<?php } elseif($type == 'r') {	?>
				<input type="hidden" name="tipo" id="tipo" value="r">
			<?php } ?>
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $assoc['id_user']; ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $assoc['id']; ?>">
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Code</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input value="<?php echo $assoc['code']; ?>" type="label" name="code" id="code" class="form-control input-lg" readonly>
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
									<input type="label" name="item_message" id="item_message" class="form-control input-lg">
								</div>
							</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
								<label for="status" class="form-control input-lg">Status</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<select class="form-control input-lg" name="status" id="status">
								<option value=""></option>
								<option value="Shiped">Shiped</option>
								<option value="Arrived">Arrived</option>
								<option value="Cancel">Cancel</option>
								<option value="Waiting">Waiting</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Title</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="label" name="item_title" id="item_title" class="form-control input-lg">
								</div>
							</div>
				</div>
				<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
										<label class="form-control input-lg">Address</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="label" name="item_address" id="item_address" class="form-control input-lg">
								</div>
							</div>
				</div>
				<div class="row">
					<input onclick="return confirm('¿Receive Item?')" class="btn btn-primary" type="submit" name="guardar" id="guardar" value="Receive">
					
				</div>
			</form>
		</div>
	</div>
</div>

<?php
//include header template
require('layout/footer.php');
?>