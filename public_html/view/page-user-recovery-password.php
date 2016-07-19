<?php
//if form has been submitted process it
if(isset($_POST['submit'])){

	
	//email validation
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	
		$query = "SELECT email FROM user WHERE email = '".$_POST['email']."'";
		$sql = mysql_query($query);
		if($row = mysql_fetch_assoc($sql))
		{
			$email = $row['email'];
			if(RecoverPasswordUser($email)){
			header('Location: /login/');
			}else{
			$error = 'Error trying to change password.';
			}
			
		}else{
			$email = $_POST['email'];
			$error = 'E-mail does not exist';
		}
	

	}else{
			$email = $_POST['email'];
			$error = 'Invalid e-mail';
		}
}
//include header template
require('layout/header.php'); 
?>


<div id="content">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
		<div class="row">	
			<div class="col-xs-3 col-md-2" >
				<a href='/'>
					<p>back</p>
				</a>
			</div>
			
			<div class="col-xs-6 col-md-8" >
				<p></p>
			</div>
		</div>
	</div>	
		<?php 
if(isset($error))
{

echo '<p class="bg-danger">'.$error.'</p>';
}
	
?>
<form  method="post" action="" autocomplete="off">
				
					<div class="row row_margin_20"  style="color:blue">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<p class="fontsize_2" >Reset Your Password</p>
						</div>
					</div>
					<div class="row row_margin_20"  style="text-align:left">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<p class="fontsize_5 maxpl" >To reset your password,please select how you want to be notify</p>
						</div>
					</div>
					<div class="row row_margin_10"  style="">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<input type="text" name="email" class="email_reset"  id="email" placeholder="email" value="<?php if(isset($email)){ echo $email; } ?>" require>
						</div>
					</div>
						
						
						<div class="row row_margin_10"  style="text-align:left;color:blue">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<p class="fontsize_4 maxpl">Please notify me by</p>
						</div>
					</div>

					<div class="row row_margin_10"  style="text-align:center;color:blue">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<p class="fontsize_3 maxpl">
								<input type="radio" name="notify" value="email" checked> Email<br>
								<input type="radio" name="notify" value="message" disabled> Text message<br>
								<input type="radio" name="notify" value="call" disabled> Call<br>
							</p>
						</div>
					</div>
					
					<div class="row row_margin_10"  style="">
						<div class="col-xs-1 col-md-4">
						
						</div>
						<div class="col-xs-10 col-md-4">
							<input type="text" name="wilwif_code" class="wilwif_reset"  id="wilwif_code" value="<?php if(isset($email)){ echo $email; } ?>" readonly>
						</div>
					</div>
					
					
					<div class="row div_input_principal"  style="color:blue; text-align: center; ">
						<div class="col-xs-12 col-md-12">
							<p class="fontsize_4 p_button" >
								<input type="submit" value="" class="botonera_button_principal" type="submit" name="submit">
								
							</P>
						</div>	
					</div>
				</form>
</div>

<style>

.div_input_principal{
	margin-bottom:-50px;
	margin-top: 71px;
}
.maxpl{
	width:193px;
	text-align:left;
	margin:auto;
}
.botonera_button_principal{
 
background-image: url("/image/logo-botonera-111-x-173.png");
background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;

}

.email_reset{
		background-image: url("/image/Casilla-364-x-53.png");
		background-size : 100% 100%;
		height: 34px;
		border-width: 0px;
		margin-top:2px;
		min-width:193px;
		max-width:193px;
		padding-left:35px;
	}
	
	.wilwif_reset{
		background-image: url("/image/Casilla-Wilwif-Code--364-x-53.png");
		background-size : 100% 100%;
		height: 34px;
		border-width: 0px;
		margin-top:2px;
		min-width:193px;
		max-width:193px;
		padding-left:100px;
	}
	a{
	
		text-decoration:none;
		color:white;
	}
	
	a:hover{
	
		text-decoration:none;
		color:white;
		font-weight: bold;
	}
 /* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
.email_reset,.wilwif_reset{
	height:53px;
	min-width:364px;
	max-width:364px;
	padding-left:60px;
}

.maxpl{
	width:364px;
}
.botonera_button_principal{
	width:111px;
	height:176px;
	
 }
}	


</style>
<?php
//include header template
require('layout/footer.php');
?>