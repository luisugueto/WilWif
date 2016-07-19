<?php 


//define page title
$title = 'Register';

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
<form method="post" action="/register/">
<div class="row ">
	<div class="col-xs-0 col-md-4">
		</div>
	<div class="col-xs-12 col-md-4">
		<input type="button" class="facebook_login fontsize_2" value="Sign up with Facebook">
	</div>
	
</div>

<div class="row">
	<div class="col-xs-0 col-md-4">
	</div>
	<div class="col-xs-12 col-md-4">
		<input type="button" class="google_login fontsize_2" value="Sign up with Google">
	</div>
</div>

<div class="row ">
	<div class="col-xs-0 col-md-4">
	</div>
	<div class="col-xs-12 col-md-4">
		<p class="fontsize_3 maxpm">or</p>
	</div>
</div>
<div class="row">
	<div class="col-xs-0 col-md-4">
	</div>
	<div class="col-xs-12 col-md-4">
		<input type="submit" class="email_login fontsize_2" value="Sign up with email">
	</div>
</div>
<div class="row" style="color:blue;">
	<div class="col-xs-0 col-md-4">
	</div>
	<div class="col-xs-12 col-md-4">
		<p class="fontsize_5 maxp" >By signing up, I agree to WilWif Terms of Service,</p>
		<p class="fontsize_5 maxp"  >Privacy Policy</P>
	</div>
</div>
<div class="row" style="color:blue; text-align: left;height:20px">
	<div class="col-xs-0 col-md-4">
	</div>
	<div class="col-xs-12 col-md-4">
		<p class="fontsize_4 maxp" >
		<input type='checkbox' name='agree' value='Agree' id="agree" required/> Agree<br>
		</P>
	</div>
</div>
</form>
<div class="row" style="color:blue; text-align: center; ">
	
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png" >
		</P>
	</div>	
</div>
</div>	
 
 <style>
 
 .p_button{
	text-align: center;
 }

 .facebook_login{
	background-image: url("/image/Facebook-Label-370-x-54.png");
	border-width: 0px;
	margin-top:30px;
	color:white;
 }
 
 .google_login{
	width: 100%;
	background-image: url("/image/Google-Label-370-x-54.png");
	border-width: 0px;
	margin-top:10px;
	margin-bottom:10px;
}
 
 .email_login{
	width: 100%;
	background-image: url("/image/Message-Label-370-x-54.png");
	border-width: 0px;
	margin-top:10px;
	margin-bottom:10px;
	color:white;
 }
 .facebook_login ,.google_login ,.email_login{

	min-width:270px;
	max-width:270px;
	height: 45px;
	padding-left:40px;
	background-size:100% 100%;
}
 
 .botonera_button_principal{
	width:83px;
	height:129px;
	margin-bottom: -300px
 }

 .maxp{
	width:270px;
	margin: auto;
	text-align:left
 }
 
 maxpm{
	width:230px;
	margin: auto;
	text-align:center
 }
 
 .row_margin_button{

margin-top:80px;
}
 /* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
.facebook_login ,.google_login ,.email_login{

	min-width:370px;
	max-width:370px;
	height: 54px;
	padding-left:20px;
}
.maxp{
	width:370px;
 }
 
 
 .row_margin_button{

margin-top:20px;
}
 
 .botonera_button_principal{
	width:111px;
	height:176px;
	margin-bottom: -200px;
 }
}


</style>
 
 <?php 
//include header template
require('layout/footer.php'); 
?>