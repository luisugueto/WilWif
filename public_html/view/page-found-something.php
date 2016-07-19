<?php  

if(isset($_POST['submit']))
{
	$wilwifcode1 = (isset($_POST['wilwifcode1']))? $_POST['wilwifcode1']:'';
	$wilwifcode2 = (isset($_POST['wilwifcode2']))? $_POST['wilwifcode2']:'';
	$wilwifcode3 = (isset($_POST['wilwifcode3']))? $_POST['wilwifcode3']:'';
	
	$wilwifcode = $wilwifcode1.'-'.$wilwifcode2.'-'.$wilwifcode3;
	$query="select code from item where code ='".$wilwifcode."'";
	
	$sql = mysql_query($query);
	if($row = mysql_fetch_assoc($sql))
	{
		header('Location: /code-received/?code='.$wilwifcode);		
	}else{
	
		$error=" WilWif-code does not exist";
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
<div class="row"  style="border-color:gray; color:blue;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-3 col-md-3" >
		
	</div>
	<div class="col-xs-6 col-md-6" >
		<p class="fontsize_3">Found Something?</p>
	</div>
	
</div>
<form  method="post" action="" autocomplete="off">
				
					<div class="row row_margin_20"  style="color:blue; font-size:20px">
						
						<div class="col-xs-12 col-md-12">
							<p class="maxpc fontsize_2">Scan WilWif Code</p>
						</div>
					</div>
					<div class="row row_margin_20"  >
						
						<div class="col-xs-12 col-md-12">
							<img src="/image/add-more-154-x-154.png"  width="154" height="154" >
						</div>
					</div>
					<div class="row row_margin_20"  style="color:blue">
						
						<div class="col-xs-12 col-md-12">
							<p class="maxpc fontsize_3">or</p>
						</div>
					</div>
					<div class="row row_margin_10"  style="color:blue">
					
						<div class="col-xs-12 col-md-12">
							<p class="maxpc fontsize_2">Enter WilWif Code</p>
						</div>
					</div>	
					<div class="row row_margin_10"  style="color:blue">
						
						<div class="col-xs-12 col-md-12">
							<div class="wilwifcodiv" >
							<input maxlength="3" class="wilwifcodiv1 fontsize_1" name="wilwifcode1" id="wilwifcode1" value=""  required>
							
							<input maxlength="3" class="wilwifcodiv1 fontsize_1 codspace" name="wilwifcode2" id="wilwifcode2" value="" required>
							
							<input maxlength="3" class="wilwifcodiv1 fontsize_1" name="wilwifcode3" id="wilwifcode3" value="" required>
							</div>
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
	height: 110px;

}

.botonera_button_principal{
 margin-bottom:-50px;
background-image: url("/image/logo-botonera-111-x-173.png");
background-color: transparent;
background-size:100% 100%;
border-width: 0px;
width:83px;
height:129px;
position: absolute;
margin-left: -41px;
 margin-top: 30px;


}

.wilwifcodiv{
	margin:auto;
	width: 200px;
	height: 35px;
	border-style: solid;
	border-color: gray;
	border-width: 1px;
	background-image:url("/image/casilla-394-x-70.png");
	background-size:100% 100%;
	line-height:35px;
}

.wilwifcodiv1{
	width: 25%;
	padding-bottom: 0px;
	padding-top: 0px;
	border-width: 0px;
	padding-left: 0px;
	background-color: transparent;
	letter-spacing: 1px;
}

.codspace{
	margin-left: 17px;
    margin-right: 17px;
	
}

.email_reset{
		width: 193px;
		background-image: url("/image/USER-LOGIN---RESETPASWORD-193-X-34.png");
		height: 34px;
		border-width: 0px;
		margin-top:2px;
		min-width:193px;
		max-width:193px;
		padding-left:35px;
	}
	
	.wilwif_reset{
		width: 193px;
		background-image: url("/image/USER-LOGIN---RESETPASWORD-193-X-34-WILDICODE.png");
		height: 34px;
		border-width: 0px;
		margin-top:2px;
		min-width:193px;
		max-width:193px;
		padding-left:35px;
	}
	

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

.botonera_button_principal{
	width:111px;
	height:176px;
	margin-top:70px;
	margin-top: 0px;
	bottom: -90px;
	left: 50%;
	margin-left: -50px;	
	padding-left: 0px;
	padding-right: 0px;
	margin-left: -55px;
	top: 20px;
 }
 
 .div_input_principal{
	height: 150px;

}

.wilwifcodiv{
	margin:auto;
	width: 394px;
	height: 70px;
	line-height:70px;
}

.wilwifcodiv1{
	width: 30%;
	padding-bottom: 0px;
	padding-top: 0px;
	border-width: 0px;
	padding-left: 0px
	font-size:70px;
	letter-spacing: 13px;
	padding-left: 16px;
}

.codspace{
	margin-left:16px;
	margin-right:16px;
}

	
 }

</style>
<?php
//include header template
require('layout/footer.php');
?>