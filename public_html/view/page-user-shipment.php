<?php 
require('layout/header.php'); 

$method="";
if(!$user->is_logged_in() ){
	header('Location: /register/');
}

if (isset($_POST['add'])) {

		if(!isset($_POST['shipment_address']) || empty($_POST['shipment_address']))
		{
			$error = 'Address required';
		}

		if(!isset($_POST['message']) || empty($_POST['message']))
		{
			$error = 'Message required';
		}
		
		if(!isset($_POST['shipment_title']) || empty($_POST['shipment_title']))
		{
			$error = 'Title required';
		}
		
		if(!isset($error))
		{
			$code_item = $_POST['item_code'];
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
	$message = $_POST['message'];
	$user_recive = $_POST['user_to'];
	$item_code = $_POST['item_code'];
	$shipment_title = $_POST['shipment_title'];
	$shipment_address = $_POST['shipment_address'];
	$user_recive = new userInfo($user_recive);
	$user_recive = $user_recive->user_id;
	$item = new item($_POST['item_code']);
	$history = "INSERT INTO history (id_user, action, date) VALUES('".$_SESSION['id']."', 'Send Item.', NOW())";
	$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	$shipment = CreateShipment($code_submit, $item->item_id, $message,$shipment_title, $shipment_address, $user_recive);
	if (is_a($shipment, 'errorCodes')) {
			$errors = $shipment->GetErrors();
			echo "<p>type Error</p>";
			foreach($errors as $error)
			{
				echo "<p>type Error".$error."</p>";
			}
			
		}else{
			header('Location: /account/shipments/');
		}
	
		
		}
	
	
}

if(isset($_GET['code'])){

	$shipment = new shipment($_GET['code']);
	if(!$shipment->shipment_id)
	{
		header('Location: /account/shipments/');
	}
	$method = 'modify';
	$shipment_id = $shipment->shipment_id;
	$shipment_title = $shipment->shipment_title;
	$shipment_message = $shipment->shipment_message;
	$shipment_status = $shipment->shipment_status;
	$shipment_code = $shipment->shipment_code;
	$shipment_address = $shipment->shipment_address;
	
	$shipment_item = $shipment->shipment_item;
	$shipment_user_from =  $shipment->shipment_user_from->user_username;
	$shipment_user_to = $shipment->shipment_user_to->user_username;
	$shipment_create_date = $shipment->shipment_create_date;
	$shipment_last_mod_date = $shipment->shipment_last_mod_date;
}else if(isset($_GET['item_code']))
{
	$shipment_item = new item($_GET['item_code']);
	$shipment_user_from = $_SESSION['username'];
	$shipment_user_to = $shipment_item->item_user;
}

?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
<div style="width: 1440px; display: inline-block; text-align: left;padding-right: 81px; padding-left: 221px;">
		<div style="background-image: url('/image/barra-account-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;">Shipment</h1>
		</div>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; height: display: inline-block;">
	
<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
	
	
	
	<form method="post">
	<div class="content_chat_div_1">
		<div  style="display: inline-block;">
			<div class="row"> 
			<div class="images_container">
			
						<div class="images_container">
						<div class="images_control">
						<a id="prevI"></a>
						<a id="nextI"></a>
						</div>
						<div class="list_container">
						<ul id="list_images" class="list_images">
					
							<?php if(isset($shipment_item) &&$shipment_item->HasPhoto())
								{
									for($i =0;$i<count($shipment_item->item_photos_url);$i++ )
									{
								?>
									<li>
										<div style="background: transparent url('<?php echo $GLOBALS['configuration']->getOption('domain').$shipment_item->item_photos_url[$i]?>') no-repeat scroll 0% 0% / 100% 100%; width:120px; height:120px"></div>
									</li>
								<?php
								}
								}else{
									?>
									<div class="uploader_clasethumb" style="background: transparent url('/image/No_image_available_125x132.png') no-repeat scroll 0% 0% / 100% 100%;"></div>
									<?php
								}
								?>
						</ul>
						</div>
						</div>		
			</div>	
			</div>	
		</div>
			
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								
								<label for="item_code" class="input_label_form">Wilwif-Code</label>
								
							  </div>
							  <div class="input_container_text_form">
							
								<input type="text" name="item_code" class="input_text_form"  id="item_code"  value="<?php if(isset($shipment_item->item_code)){ echo $shipment_item->item_code; } ?>" readonly>
							</div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="user_from" class="input_label_form">From</label>
							 </div>
							  <div class="input_container_text_form">
									<input type="text" name="user_from" class="input_text_form"  id="user_from"   value="<?php if(isset($shipment_user_from)){ echo $shipment_user_from; } ?>" readonly>
								
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="user_to" class="input_label_form">To</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="user_to" class="input_text_form"  id="user_to"   value="<?php if(isset($shipment_user_to)){ echo $shipment_user_to; } ?>" readonly>
								</div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_code" class="input_label_form">Code</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_code" class="input_text_form"  id="shipment_code"   value="<?php if(isset($shipment->shipment_code)){ echo $shipment->shipment_code; } ?>" readonly>
							   </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_title" class="input_label_form">Title</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_title" class="input_text_form"  id="shipment_title"   value="<?php if(isset($shipment->shipment_title)){ echo $shipment->shipment_title; } ?>" >
							   </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_status" class="input_text_form"  id="shipment_status"   value="<?php if(isset($shipment->shipment_status)){ echo $shipment->shipment_status; } ?>" readonly>
							  
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="message" class="input_label_form">Message</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="message" class="input_text_form"  id="message"   value="<?php if(isset($shipment->shipment_message)){ echo $shipment->shipment_message; } ?>">
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_address" class="input_label_form">Address</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_address" class="input_text_form"  id="shipment_address"   value="<?php if(isset($shipment->shipment_address)){ echo $shipment->shipment_address; } ?>">
							  </div>
						 </div>
						 </div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_creation_date" class="input_label_form">Creation</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_creation_date" class="input_text_form"  id="shipment_creation_date"   value="<?php if(isset($shipment->shipment_create_date)){ echo $shipment->shipment_create_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="shipment_mod_date" class="input_label_form">Mod Date</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="shipment_mod_date" class="input_text_form"  id="shipment_mod_date"   value="<?php if(isset($shipment->shipment_last_mod_date)){ echo $shipment->shipment_last_mod_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/account/shipments/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php 
							if(!isset($order))
							{
							?>	
								<div class="option_container_page">
								<input class="search_option_result option_add" type="submit" name="add" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Add</p>
								</div>
							<?php	
							}
							?>	
							
							
						
					</div>
				</div>
				</form>
	
	
	
</div>

	</div>
</div>
<script>	


	
	
	
	
	
	
	
</script>
<style>
.input_text_form{
padding-top: 0px;
 padding-left: 20px;
 border-width: 0px;
 width: 350px;
 padding-right: 20px;
 height: 50px;
 background-color: transparent;
 text-align: center;
}
.input_select_form {
 height: 50px;
 background-color: transparent;
 text-align: center;
 border-width: 0px;
 width: 370px;
}

.input_container_text_form{
	float: left;
	width: 350px;
	overflow: hidden;
}

.input_container_form{
	width: 460px;
	background-size: 100% 100%;
	height: 50px;
	background-image: url('/image/barra-register-405-26.png');
	display: inline-block;
}

.input_container_label_form{
	float: left;
	height: 50px;
	width: 110px;
	padding-top: 15px;
}
</style>
<script>

function CarrucelNextClick()
{
	var count = $("#list_images li").size();
	var p = parseInt( $( "#list_images" ).css('top'));
	var topp = 0;
	if(count > 1)
	{
	if(p<= (count-1) * -100)
	{
		$('#list_images').animate({
		top: "+="+(count-1) * 100+"%" }, 200, function() {
		// Animation complete.
			});
		}else
		{
			$('#list_images').animate({
		top: "-=100%" }, 200, function() {
		// Animation complete.
	  });
		}
	}
}

function CarrucelPrevClick()
{
	var count = $("#list_images li").size();
	var p = parseInt( $( "#list_images" ).css('top'));
	var topp = 0;
	if(count > 1)
	{
		if(p>=0)
		{
			topp = -(count-1) * 100;
			$('#list_images').animate({
			top: "+="+topp+"%" }, 200, function() {
		// Animation complete.
			});
		}else
		{
			$('#list_images').animate({
		top: "+=100%" }, 200, function() {
		// Animation complete.
		});
		}
	}
	
	 
}

$(document).ready(function()
 {	
   $('#prevI').click(function() {
		CarrucelPrevClick();
	});
	
	$('#nextI').click(function() {
		CarrucelNextClick();
	
	});
 });
</script>

<style>

.list_container{
	overflow: hidden; 
	height: 120px;
	width: 120px;
}
.list_images {
	background-image: url('/image/No_image_available_125x132.png');
    background-size: 100% 100%;
	list-style: outside none none;
	margin: 0px;
	padding: 0px;
	position: relative;
	top: 0px; 
	bottom: 0px;
	width: 100%;
	height: 100%;
}
.list_images li {
	display:block;
	float:left;
	position:relative;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	background-color:white;
	width: 100%;
	height: 100%;
}
.list_images div {
	margin: 0px;
	width:100%;
	height:100%;
}


.images_container{
	float: left;
	margin-top: 10px;
}

.images_holder{
	clear: both; 
	content: "";
	display: table;
	padding-left: 20px;

}

.images_control{
  position: relative;
  top: 75px;
  height: 30px;
  margin-top: -32px;
  z-index: 2;
  margin-left: -23px;
  width: 176px;
}
a#prevI {
	background:url(/image/flecha_atras_9x16.png)  no-repeat scroll 100% 100% / 100% 100%; 
	height: 32px; float: left; width: 30px; margin-left: -2px;
	background-color:transparent;
}



a#nextI {
	background:url(/image/flecha_adelante_9x16.png)  no-repeat scroll 100% 100% / 100% 100%;
height: 32px; float: right; width: 28px;	
}


</style>
<?php
//include header template
require('layout/footer.php');
?>