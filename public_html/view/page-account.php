<?php 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: /login/'); } 

//define page title
$title = 'Inicio';

//include header template
require('layout/header.php'); 
?>

<div id="content">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
<div class="row">	
	<div class="col-xs-3 col-md-2" >
		<a href='/logout/'>
			<p>logout</p>
		</a>
	</div>
	
	<div class="col-xs-6 col-md-8" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-2" >
	<a href="/account/found-items"><p>my list</p></a>
	</div>
	</div>
</div>	


	<div class="row" style="margin-top:50px">
		<div class="col-xs-0 col-md-4" >
		</div>
		<a href="/found-something/">
		<div class="col-xs-12 col-md-4" >
			<img class="home_img_found" src="/image/Found-Something-307-x-231.png"  width="307" height="231" >
		</div>
		</a>
	</div>
	
	<div class="row">
		<div class="col-xs-0 col-md-4" >
		</div>
		<a href="/account/found-category/">
			<div class="col-xs-12 col-md-4" >
				<img class="home_img_keep" src="/image/Keep-it-Safe-295-x-197.png" width="295" height="197" >
			</div>
		</a>
	</div>
	<div class="row div_input_principal"  style="color:blue; text-align: center; ">
		<div class="col-xs-12 col-md-12">
			<p class="fontsize_4 p_button" >
				<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
			</P>
		</div>	
	</div>
</div>
	

<style>


 .home_img_found{
	width:200px;
	height:154px;
 }
 
 .home_img_keep{
	width:197px;
	height:131px;
 }

.botonera_button_principal{
 margin-bottom:-50px;

background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;
margin-top:50px;

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
	margin-top:0px;
 }
 
 .home_img_found{
	width:307px;
	height:231px;
 }
 
 .home_img_keep{
	width:295px;
	height:197px;
 }
}	
</style>
<?php 
//include header template
require('layout/footer.php'); 
?>
