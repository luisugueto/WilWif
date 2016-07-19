<?php 
require('layout/header.php'); 
$url_public = "http://wilwif.local:86";

if(!$user->is_logged_in() ){
	
		header('Location: /');
	}
	
if (isset($_POST['block'])){
	if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		
		$item_code = $_POST['item_code'];
		
		$item = BlockItem($item_code);
			if (is_a($item, 'errorCodes')) {
				$errors = $item->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'Wilwif-Code is require.';
	}

}if (isset($_POST['unblock'])){
if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		
		$itemcode = $_POST['item_code'];
		
		$item = UnblockItem($itemcode);
			if (is_a($item, 'errorCodes')) {
				$errors = $item->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'Wilwif-Code is require.';
	}
}else if (isset($_POST['modify'])){
	
if(isset($_POST['item_code']) && !empty($_POST['item_code']) &&isset($_POST['item_status']))
{
		$item_code = $_POST['item_code'];
		$item_status =  $_POST['item_status'];
		$item = ModifyStatusItem($item_code,$item_status);
			if (is_a($item, 'errorCodes')) {
				$errors = $item->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}
	
		
	}else{
		$error = 'Item code is require.';
	}


}
else if (isset($_POST['deleted'])){


if(isset($_POST['item_code']) && !empty($_POST['item_code']))
	{
		
		$item_code = $_POST['item_code'];
		
		$item = DeleteItem($item_code);
			if (is_a($item, 'errorCodes')) {
				$errors = $item->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
				header('Location: /items/found/');
			}
	
		
	}else{
		$error = 'Wilwif-Code is require.';
	}
}
//include header template

if(isset($_GET['item_code']))
{
	$item = new item($_GET['item_code']);
	if(!isset($item->item_id))
	{
		die("Item does not exist");
	}
}else{
	die("Access Denied");
}
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png'); height:100px">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/items/found/'>
			<p class="fontsize_3" style="margin-bottom: 0px;"><img src="/image/flecha2-27-46.png">back</p>
		</a>
		</div>
		
		<div class="col-xs-6 col-md-6">	
			<a href="/">
				<img style="margin-top: 2%; margin-bottom: 3%;" src="/image/Logotipo-110-x-32.png" title="logo" width="110" height="32" >
			</a>
		</div>
		<div class="col-xs-3 col-md-3">
		
		</div>
	</div>
</header>
<div id="content">


<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
<form method="post">


			<div class="row">
					<div class="col-xs-0 col-md-3" >
					</div>
					<div class="col-xs-12 col-md-6" >
					<!--
						<div class="images_holder">
			
						</div>		
					-->
					
						<?php 
						if($item->item_category_slug == 'Phone')
						{
							
							echo '<img class="img_category_phone" src="/image/mobile-1-59-x-97.png"  width="59" height="97" >';
							
						}else if($item->item_category_slug == 'Key')
						{
							
							echo '<img class="img_category_key" src="/image/key-1-97-x-97.png"  width="97" height="97" >';
							
						}else if($item->item_category_slug == 'Case')
						{
							
							echo '<img  class="img_category_suitecase" src="/image/maleta-1-98-x-83.png"  width="98" height="83" >';
							
						}else if($item->item_category_slug == 'Tablet')
						{
							
							echo '<img class="img_category_tablet" src="/image/tablet-1-73-x-96.png"  width="73" height="96" >';
							
						}else if($item->item_category_slug == 'Backpack')
						{
							
							echo '<img class="img_category_backpack" src="/image/bulto-1-95-x-97.png"  width="95" height="97" >';
							
						}else if($item->item_category_slug == 'Luggage')
						{
							
							echo '<img class="img_category_luggage" src="/image/maleta-rueda-1-55-x-97.png" width="55" height="97" >';
							
						}else if($item->item_category_slug == 'Laptop')
						{
							
							echo '<img class="img_category_laptop" src="/image/laptop-1-97-x-67.png"  width="97" height="67" >';
							
						}else if($item->item_category_slug == 'Camera')
						{
							
							echo '<img class="img_category_camera" src="/image/camara-1-98-x-70.png"  width="98" height="70" >';
							
						}else if($item->item_category_slug == 'Passport')
						{
							
							echo '<img class="img_category_pass" src="/image/pass-68-x-94.png"  width="68" height="94" >';
							
						}else if($item->item_category_slug == 'Driver License')
						{
							
							echo '<img class="img_category_identitycard" src="/image/ID-1-98-x-66.png"  width="98" height="66" >';
							
						}else if($item->item_category_slug == 'Credit / Debit Card')
						{
							
							echo '<img class="img_category_creditcard" src="/image/credit-1-card-98-x-66.png"  width="98" height="66" >';
							
						}else if($item->item_category_slug == 'Other')
						{
							
							echo '<img class="img_category_other" src="/image/crus-93-x-93.png"  width="93" height="93" >';
							
						}
					
					
					?>
					<input class="label_text_input" type="hidden" name="item_category_slug"  id="item_category_slug"   value="<?php if(isset($item->item_category_slug)){ echo $item->item_category_slug; } ?>"  readonly>
					
					<input class="label_text_input" type="hidden" name="item_category"  id="item_address"   value="<?php if(isset($item->item_category)){ echo $item->item_category; } ?>"  readonly>
					</div>
				</div>	
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:black;"><strong><?php if(isset($item->item_category_slug)){ echo $item->item_category_slug; } ?> of</strong> <?php if(isset($item->item_user)){ echo $item->item_user; } ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Wilwif-Code:</span><span style="color:orange"> <?php if(isset($item->item_code)){ echo $item->item_code; } ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Posted Date:</span><?php if(isset($item->create_date)){ echo (new DateTime($item->item_date))->format('m-d-y');} ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Status:</span><span style="color:<?php if(isset($item->item_status)){ if($item->item_status == 'Active'){ echo 'greenyellow';}else if($item->item_status == 'Lost'){ echo 'red';}else if($item->item_status == 'Found'){ echo 'yellow'; }   } ?>"> <?php if(isset($item->item_status)){ echo $item->item_status; } ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Description:</span><span style="color:orange"><?php if(isset($item->item_description)){ echo $item->item_description; } ?></span></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Brand:</span><span style="color:orange"><?php if(isset($item->item_brand)){ echo $item->item_brand; } ?></span></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p style="color:blue;"><span style="color:white;">Color:</span><span style="color:orange"><?php if(isset($item->item_color)){ echo $item->item_color; } ?></span></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12 col-md-12" >	
					<p ><span style="color:white;">Model:</span><span style="color:orange"><?php if(isset($item->item_model)){ echo $item->item_model; } ?></span></p>
				</div>
			</div>
	<!--		
	<div class="content_chat_div_1">
		
			
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="item_code" class="input_label_form">Wilwif-Code</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="item_code" class="input_text_form"  id="item_code"  value="<?php if(isset($item->item_code)){ echo $item->item_code; } ?>" <?php if(isset($username)){ echo 'readonly'; } ?> readonly>
							  </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="user" class="input_label_form">User Holder</label>
							  </div>
							  <div class="input_container_text_form">
							  <a href="/users/user/?username=<?php if(isset($item->item_user)){ echo $item->item_user; } ?>">
								<input type="text" name="user" class="input_text_form"  id="user"   value="<?php if(isset($item->item_user)){ echo $item->item_user; } ?>" readonly>
							  </div>
							  </a>
						 </div>
						 </div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="title" class="input_label_form">Title</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="title" class="input_text_form"  id="title"   value="<?php if(isset($item->item_title)){ $item->item_title; } ?>" readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="category" class="input_label_form">Category</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="category" class="input_text_form"  id="category"   value="<?php if(isset($item->item_category_slug)){ echo $item->item_category_slug; } ?>" readonly>
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="item_title" class="input_label_form">Brand</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="brand" class="input_text_form"  id="brand"   value="<?php if(isset($item->item_brand)){ echo $item->item_brand; } ?>" readonly>
							   </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="color" class="input_label_form">Color</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="color" class="input_text_form"  id="color"   value="<?php if(isset($item->item_color)){ echo $item->item_color; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="number" class="input_label_form">Number</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="number" class="input_text_form"  id="number"   value="<?php if(isset($item->item_number)){ echo $item->item_number; } ?>" readonly>
							  </div>
						 </div>
						</div>
						
						 <div class="row"> 
						  <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Status</label>
							  </div>
							  <div class="input_container_text_form">
								<select name="item_status">
									<option value="<?php if(isset($item->item_status)){ echo $item->item_status; } ?>"><?php if(isset($item->item_status)){ echo $item->item_status; } ?></option>
									<option>Block</option>
									<option>Active</option>
								</select>
							 </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Creation</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($item->item_date)){ echo $item->item_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
						<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="status" class="input_label_form">Mod Date</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="status" class="input_text_form"  id="status"   value="<?php if(isset($item->item_last_mod_date)){ echo $item->item_last_mod_date; } ?>" readonly>
							  </div>
						 </div>
						</div>
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/items/found/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						<?php 
							if(isset($item))
							{
							?>	
							
							<div class="option_container_page">
								<input class="search_option_result option_deleted" type="submit" name="deleted" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Deleted</p>
							</div>
							<?php
							if($item->item_status != 'Block')
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
		-->					
							
						
					</div>
				</div>
				</form>
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
$actualpage = "Item";
require('layout/footer.php');
?>