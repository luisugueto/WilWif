<?php 

if(isset($_POST['save']))
{
	$resultShow = $_POST['resultShow'];
	$attemps = $_POST['attemps'];
	$email = $_POST['email'];
	$domain = $_POST['domain'];
	
	$query = "UPDATE configuration SET";
	$query = $query." `value` ='".$email."'";
	$query = $query." WHERE `option` ='email' "; 
	echo  $query;
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());

	$query = "UPDATE configuration SET";
	$query = $query." `value` = '".$domain."'";
	$query = $query." WHERE `option` ='domain'"; 
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());

	$query = "UPDATE configuration SET";
	$query = $query." `value` = '".$attemps."'";
	$query = $query." WHERE `option` ='maxattemps'"; 
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());

	$query = "UPDATE configuration SET";
	$query = $query." `value` = '".$resultShow."'";
	$query = $query." WHERE `option` ='nresult'"; 
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());

	}

	$query = "select `option`,`value` from configuration";
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());
	
	while($row = mysql_fetch_assoc($sql))
	{
		if($row['option']=="nresult")
		{
			$resultShow = $row['value'];
		}
		if($row['option']=="maxattemps")
		{
			$attemps = $row['value'];
		}
		if($row['option']=="email")
		{
			$email = $row['value'];
		}
		if($row['option']=="domain")
		{
			$domain = $row['value'];
		}
		
	}
require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Configurations</h2>
		</div>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter">
	<form method="post">
				<div class="content_chat_div_1">
		
				<div >
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="email" class="input_label_form">Main email</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="email" class="input_text_form"  id="email"  value="<?php if(isset($email)){ echo $email; } ?>">
							  </div>
						 </div>
					</div>	
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="domain" class="input_label_form">User domain</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="domain" class="input_text_form"  id="domain"   value="<?php if(isset($domain)){ echo $domain; } ?>" >
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="attemps" class="input_label_form">Max login attemps</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="attemps" class="input_text_form"  id="attemps"   value="<?php if(isset($attemps)){ echo $attemps; } ?>" >
							  </div>
						 </div>
					</div>
					<div class="row"> 
						 <div class="input_container_form">
							  <div class="input_container_label_form">
								<label for="resultShow" class="input_label_form">Result show</label>
							  </div>
							  <div class="input_container_text_form">
								<input type="text" name="resultShow" class="input_text_form"  id="resultShow"   value="<?php if(isset($resultShow)){ echo $resultShow; } ?>">
							  </div>
						 </div>
					</div>
					
				</div>
				</div>
				<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/">
								<input class="search_option_result option_back" type="button">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
						
							
							<div class="option_container_page">
								<input class="search_option_result option_create" type="submit" name="save" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Save</p>
							</div>
							
						
					</div>
				</div>
				</form>
</div>
<style>
@media all and (max-width: 1024px)
{
	.content_chat_div_1{
		padding: 67px 35px 105px;
	}
}

@media all and (max-width: 420px)
{
	.content_chat_div_1{
		padding-top: 45px; padding-bottom: 38px;
	}
}
</style>
<?php 
//include header template
require('layout/footer.php');
?>
