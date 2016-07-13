<?php 
require('layout/header.php'); 
$url_public = "http://wilwif.local:86";

if(!$user->is_logged_in() ){
	
		header('Location: /');
	}
	
	if (isset($_POST['block'])){
	if(isset($_POST['order_code']) && !empty($_POST['order_code']))
	{
		
		$order_code = $_POST['order_code'];
		
		$order = BlockOrder($order_code);
			if (is_a($order, 'errorCodes')) {
				$errors = $order->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'order Code is require.';
	}

}if (isset($_POST['unblock'])){
if(isset($_POST['order_code']) && !empty($_POST['order_code']))
	{
		
		$order_code = $_POST['order_code'];
		
		$order = UnblockOrder($order_code);
			if (is_a($order, 'errorCodes')) {
				$errors = $order->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'order code is require.';
	}
}else if(isset($_POST['modify'])){
if(isset($_POST['order_code']) && !empty($_POST['order_code']) &&isset($_POST['order_status']))
{
		$order_code = $_POST['order_code'];
		$order_status =  $_POST['order_status'];
		$order = ModifyStatusOrder($order_code,$order_status);
			if (is_a($order, 'errorCodes')) {
				$errors = $order->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'order code is require.';
	}

}else
if (isset($_POST['deleted'])){


if(isset($_POST['order_code']) && !empty($_POST['order_code']))
	{
		
		$order_code = $_POST['order_code'];
		
		$order = DeleteOrder($order_code);
			if (is_a($order, 'errorCodes')) {
				$errors = $order->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
				header('Location: /orders/');
			}
	
		
	}else{
		$error = 'order code is require.';
	}
}

if(isset($_GET['order_code']))
{
	$order = new order($_GET['order_code']);
	if(!isset($order->order_id))
	{
		die("order does not exist");
	}
}else{
	die("Access Denied");
}

?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_order">
			<h2 class="header_title_1">Order</h2>
		</div>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter">
<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>


<form method="post">
	<div class="content_chat_div_1">
		<div  style="display: inline-block;">
			<div class="images_container">
			
						<div class="images_container">
						<div class="images_control">
						<a id="prevI"></a>
						<a id="nextI"></a>
						</div>
						<div class="list_container">
						<ul id="list_images" class="list_images">
					
							<?php if($order->order_item->HasPhoto())
								{
									for($i =0;$i<count($order->order_item->item_photos_url);$i++ )
									{
								?>
									<li>
										<div style="background: transparent url('http://wilwif.local:86<?php echo $order->order_item->item_photos_url[$i]?>') no-repeat scroll 0% 0% / 100% 100%;"></div>
									</li>
								<?php
								}
								}else{
									?>
									<div class="uploader_clasethumb" style="background: transparent url('http://wilwif.local:86/image/No_image_available_125x132.png') no-repeat scroll 0% 0% / 100% 100%;"></div>
									<?php
								}
								?>
						</ul>
						</div>
						</div>		
			</div>	
		</div>
			
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								
								<label for="order_code" class="input_label_form">Wilwif-Code</label>
								
							  </div>
							  <div class="input_container_text_form">
								<?php 
									if($order->order_item->item_type == "Found")
									{
									?>
									<a href="/items/found/item/?item_code=<?php if(isset($order->order_item->item_code)){ echo $order->order_item->item_code; } ?>">
									
									<?php
									}else
									{
									?>
									<a href="/items/lost/item/?item_code=<?php if(isset($order->order_item->item_code)){ echo $order->order_item->item_code; } ?>">
									
									<?php
									}
								?>
								<input type="text" name="order_code" class="input_text_form"  id="order_code"  value="<?php if(isset($order->order_item->item_code)){ echo $order->order_item->item_code; } ?>" readonly>
								</a>
							 </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="user_from" class="input_label_form">From</label>
							 </div>
							  <div class="input_container_text_form">
								<a href="/users/user/?username=<?php if(isset($order->order_user_from->user_username)){ echo $order->order_user_from->user_username; } ?>">
									<input type="text" name="user_from" class="input_text_form"  id="user_from"   value="<?php if(isset($order->order_user_from->user_username)){ echo $order->order_user_from->user_username; } ?>" readonly>
								</a>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="user_to" class="input_label_form">To</label>
							  </div>
							  <div class="input_container_text_form">
								<a href="/users/user/?username=<?php if(isset($order->order_user_to->user_username)){ echo $order->order_user_to->user_username; } ?>">
									<input type="text" name="user_to" class="input_text_form"  id="user_to"   value="<?php if(isset($order->order_user_to->user_username)){ echo $order->order_user_to->user_username; } ?>" readonly>
								</a>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_code" class="input_label_form">Code</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="order_code" class="input_text_form"  id="order_code"   value="<?php if(isset($order->order_code)){ echo $order->order_code; } ?>" readonly>
							   </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<select name="order_status">
									<option value="<?php if(isset($order->order_status)){ echo $order->order_status; } ?>"><?php if(isset($order->order_status)){ echo $order->order_status; } ?></option>
									<option value="Shipped">Shipped</option>
									<option value="In Transit">Transit</option>
									<option value="Out for Delivery">Out for Delivery</option>
									<option value="Delivered">Delivered</option>
								<select>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_message" class="input_label_form">Message</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="order_message" class="input_text_form"  id="order_message"   value="<?php if(isset($order->order_message)){ echo $order->order_message; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_address" class="input_label_form">Address</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="order_address" class="input_text_form"  id="order_address"   value="<?php if(isset($order->order_address)){ echo $order->order_address; } ?>" readonly>
							  </div>
						 </div>
						 </div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_creation_date" class="input_label_form">Creation</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="order_creation_date" class="input_text_form"  id="order_creation_date"   value="<?php if(isset($order->order_create_date)){ echo $order->order_create_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="order_mod_date" class="input_label_form">Mod Date</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="order_mod_date" class="input_text_form"  id="order_mod_date"   value="<?php if(isset($order->order_last_mod_date)){ echo $order->order_last_mod_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/orders/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php 
							if(isset($order))
							{
							?>	
							
							<div class="option_container_page">
								<input class="search_option_result option_deleted" type="submit" name="deleted" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Deleted</p>
							</div>
							<?php
							if($order->order_status != 'On Hold')
							{
							?>
							<div class="option_container_page">
								<input class="search_option_result option_block" type="submit" name="block" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Block</p>
							</div>
							<?php
							}else{
							?>
							<div class="option_container_page">
								<input class="search_option_result option_unblock" type="submit" name="unblock" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Unblock</p>
							</div>
							<?php
							}
							?>
							<div class="option_container_page">
								<input class="search_option_result option_modify" type="submit" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Modify</p>
							</div>
							<?php	
							}
							?>	
							
							
						
					</div>
				</div>
				</form>




	</div>
</div>
<style>
.content_chat_div_1{
	height:auto;
	padding-top: 90px;
	padding-bottom: 87px;
}

.row{
	margin-bottom: 5px;
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