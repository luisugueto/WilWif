<?php 
require('layout/header.php'); 
$error = array();
$error['error'] = false;
$method="";
if(!$user->is_logged_in() ){
	header('Location: /register/');
}


?>

<div id="content">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">
	
<div class="row">	
	<div class="col-xs-3 col-md-2" >
		<a href='/account/'>
			<p>back</p>
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
<div class="row"  style="border-color:gray;color:blue;margin-bottom: 5px; margin-top: 10px;">
	<div class="col-xs-0 col-md-4" >
		
	</div>
	<div class="col-xs-12 col-md-4" >
		<p>Keep it Safe</p>
	</div>
	<div class="col-xs-0 col-md-2" >
		
	</div>
	<div class="col-xs-12 col-md-2" style="color:gray" >
		<p>Select your Choice</p>
	</div>
	
</div>
	<div class="row"  style="margin-bottom:50px;" >
		
		<div class="col-xs-4 col-md-2 item_category_img"  >
			<a href="/account/found-item/?item_category=Phone">
				<img class="img_category_phone"  src="/image/mobile-1-59-x-97.png" title="logo" width="59" height="97" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Key">
				<img class="img_category_key" src="/image/key-1-97-x-97.png" title="logo" width="97" height="97" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Case">
				<img class="img_category_suitecase" src="/image/maleta-1-98-x-83.png" title="logo" width="98" height="83" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Tablet">
				<img class="img_category_tablet"  src="/image/tablet-1-73-x-96.png" title="logo" width="73" height="96" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Backpack">
				<img class="img_category_backpack" src="/image/bulto-1-95-x-97.png" title="logo" width="95" height="97" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Luggage">
				<img class="img_category_luggage" src="/image/maleta-rueda-1-55-x-97.png" title="logo" width="55" height="97" >
				
			</a>
		 </div>
		<div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Laptop">
				<img class="img_category_laptop" src="/image/laptop-1-97-x-67.png" title="logo" width="97" height="67" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img">
			<a href="/account/found-item/?item_category=Camera">
				<img class="img_category_camera" src="/image/camara-1-98-x-70.png" title="logo" width="98" height="70" >
				
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Passport">
				<img class="img_category_pass" src="/image/pass-68-x-94.png" title="logo" width="68" height="94" >
				
			</a>
		 </div>
		<div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Driver License">
				<img class="img_category_identitycard" src="/image/ID-1-98-x-66.png" title="logo" width="98" height="66" >
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img">
			<a href="/account/found-item/?item_category=Credit / Debit Card">
				<img class="img_category_creditcard" src="/image/credit-1-card-98-x-66.png" title="logo" width="98" height="66" >
			</a>
		 </div>
		 <div class="col-xs-4 col-md-2 item_category_img" >
			<a href="/account/found-item/?item_category=Other">
				<img class="img_category_other" src="/image/crus-93-x-93.png" title="logo" width="93" height="93" >
				<p style="color :gray">Other</p>
			</a>
		 </div>
		 
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


.botonera_button_principal{
 margin-bottom:-50px;

background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;
margin-top:50px;

}
.item_category_img{
	height: 125px;
	margin-bottom: 0px;
	border-style: solid;
	border-width: 1px;
}

.item_category_img img{
	margin-top: 25px;
}

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

	.item_category_img{
		height: 147px;
	}
	
	.item_category_img img{
	margin-top: 25px;
}

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