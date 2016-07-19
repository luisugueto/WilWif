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
	if(!isset($item->item_id) || $item->item_type !="Lost")
	{
		die("Item does not exist");
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
		<div class="header_div_3 header_div_found_item">
			<h2 class="header_title_1">Lost Item</h2>
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
					
							<?php if($item->HasPhoto())
								{
									for($i =0;$i<count($item->item_photos_url);$i++ )
									{
								?>
									<li>
										<div style="background: transparent url('<?php echo $GLOBALS['configuration']->getOption('domain').$item->item_photos_url[$i]?>') no-repeat scroll 0% 0% / 100% 100%;"></div>
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
require('layout/footer.php');
?>