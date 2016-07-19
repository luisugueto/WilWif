<?php 
if(!$user->is_logged_in() ){
	header('Location: /');	
}
require('layout/header.php'); 

?>
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
	<div class="row">	
	<div class="col-xs-3 col-md-2" >
	<a href='/account/'>
	<p>back</p></a>
	</div>
	
	<div class="col-xs-6 col-md-8" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-2" >
	
	</div>
	</div>
</div>
<div class="row"  style="border-color:gray; color:blue;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-4 col-md-4" >
		
	</div>
	<div class="col-xs-4 col-md-4" >
		<p>WilWif Store</p>
	</div>
	
</div>
<div id="content">	

<div class="row div_input_principal"  style="color:blue; text-align: center; ">
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
		</P>
	</div>	
</div>
</div>	
<style>
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


.botonera_button_principal{
	width:111px;
	height:176px;
	margin-top:0px;
 }
}

</style>
<?php
//include header template
require('layout/footer.php');
?>