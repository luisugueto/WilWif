<?php 

if(isset($_POST['save']))
{
	$resultShow = $_POST['resultShow'];
	$attemps = $_POST['attemps'];
	$email = $_POST['email'];
	$domain = $_POST['domain'];
	$domainadmin = $_POST['domainadmin'];
	
	$query = "UPDATE configuration SET";
	$query = $query." `value` ='".$domainadmin."'";
	$query = $query." WHERE `option` ='domainadmin' "; 
	$sql = mysql_query($query)or die('error at try to access data' . mysql_error());
	
	
	$query = "UPDATE configuration SET";
	$query = $query." `value` ='".$email."'";
	$query = $query." WHERE `option` ='email' "; 
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
		
		if($row['option']=="domainadmin")
		{
			$domainadmin = $row['value'];
		}
		
	}
require('layout/header.php'); 
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png');">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-3 col-md-3">	
		<a href='/'>
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
<div id="content" style="margin-top:30px;">

	<form method="post">
	
						<div class="row ">
							
							<div class="col-xs-12 col-md-12 ">
								<div>
								<label class="label_input_text" class="fontsize_4">Email:</label><input type="text" name="email" class="label_text_input fontsize_2"  id="email"  value="<?php if(isset($email)){ echo $email; } ?>">
								</div>
							</div>
						</div>	
						<hr>
						<div class="row ">
							<div class="col-xs-12 col-md-12 ">
								<div>	
									<label class="label_input_text"  class="fontsize_4">Domain:</label><input type="text" name="domain" class="label_text_input fontsize_2"  id="domain"   value="<?php if(isset($domain)){ echo $domain; } ?>" >
								</div>
							</div>
						</div>
						<hr>						
						<div class="row ">
							<div class="col-xs-12 col-md-12 ">
								<div>
								<label class="label_input_text"  class="fontsize_4">Domain Admin:</label><input type="text" name="domainadmin" class="label_text_input fontsize_2"  id="domainadmin"   value="<?php if(isset($domainadmin)){ echo $domainadmin; } ?>">
								</div>
							</div>
						</div>
						<hr>						
						<div class="row ">
							<div class="col-xs-12 col-md-12 ">
								<div>
									<label class="label_input_text" class="fontsize_4">Max Attemps:</label><input type="text" name="attemps" class="label_text_input fontsize_2"  id="attemps"   value="<?php if(isset($attemps)){ echo $attemps; } ?>">
								</div>
							</div>
						</div>	
						<hr>
						<div class="row ">
							<div class="col-xs-12 col-md-12 " >
								<div>
									<label class="label_input_text" class="fontsize_4">Result Shows</label><input type="text" name="resultShow" class="label_text_input fontsize_2"  id="resultShow"   value="<?php if(isset($resultShow)){ echo $resultShow; } ?>">
								</div>
							</div>
						</div>	
						<div class="row ">
							<div class="col-xs-12 col-md-12 ">
							<input   class="fontsize_3 " style="border-width: 0px; background-color: transparent; color: white;text-align:center; margin:auto;" type="submit" name="save" value="Save">
							</div>
						</div>	
							
					
				</form>
</div>
<style>

.label_input_text{
	color:white;
	width:200px;
	text-align: center;

}


.label_text_input{
		width: 300px;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		border-style: solid;
		padding-left:10px;
	}
	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

.label_input_text{

text-align:left;
}
.label_text_input{
	width: 500px;
}

}
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
$actualpage = "Configurations";
require('layout/footer.php');
?>
