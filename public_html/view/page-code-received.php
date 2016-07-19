<?php  
if(isset($_GET['code']))
{

}else{

	header('Location: /found-something/');
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
<div class="row"  style="border-color:gray; color:orange;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;">
	<div class="col-xs-0 col-md-0" >
		
	</div>
	<div class="col-xs-12 col-md-12" >
		<p class="fontsize_3"><strong>WilWif Code:</strong> <?php echo $_GET['code']; ?></p>
	</div>
	
</div>
<form  method="post" action="" autocomplete="off">
				
					<div class="row row_margin_10"  style="color:blue;">
						
						<div class="col-xs-12 col-md-12">
							<p  class="maxpc fontsize_2" >Thank you for HONESTY!!</p>
						</div>
					</div>
					<div  class="row row_margin_10 maxpc "  style="color:blue;">
						
						<div class="col-xs-12 col-md-12">
							<p class="maxpc fontsize_4">What is the best way for the item's</p>
							<p class="maxpc fontsize_4">owner to contact you?</p>
						</div>
					</div>
					<div class="row row_margin_5"  style="text-align:center;color:blue">
						
						<div class="col-xs-12 col-md-12">
							<p class="maxpl fontsize_4">
								<input type="radio" name="notify" value="email" disabled> Anonymous<span class="fontsize_5" style="font-style: italic;">- I'd rather not be contacted</span><br>
								<input type="radio" name="notify" value="message" disabled> Email<span class="fontsize_5"style="font-style: italic;"> - Contact me by email</span><br>
								<input type="radio" name="notify" value="call" disabled> Call<span class="fontsize_5" style="font-style: italic;">- Please call me</span><br>
								<input type="radio" name="notify" value="text" disabled> Text Message<span class="fontsize_5" style="font-style: italic;">- Contact me by text message</span><br>
							</p>
						</div>
					</div>
					
					<div class="row row_margin_10"  style="color:blue">
						
						<div class="col-xs-12 col-md-12">
							<p class="maxpl fontsize_4">Message - <span class="fontsize_5" style="font-style: italic;">- A brief message to the owner</span></p>
							<textarea maxlength="20" class="message" style="resize: none;"> </textarea>
							<div class="row_margin_3" style="text-align: right; margin: auto; width: 193px; padding-right: 10px;">
							<input class="search_option_result option_back" style="height: 22px; background-color: transparent; border-width: 0px;" type="submit" name="submit" value="Submit">
							</div>
						</div>
					</div>
					
					<div class="row div_input_principal"  style="color:blue; text-align: center; ">
						<div class="col-xs-12 col-md-12">
							<p class="fontsize_4 p_button" >
								<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
							</P>
						</div>	
					</div>
				</form>
</div>



<style>

.maxpl{
	margin:auto;
	text-align:left;
	width:193px;
}

.message{
		width: 193px;
		background-image: url("/image/casilla-350-x-104.png");
		background-size:100% 100%;
		height: 52px;
		border-width: 0px;
		margin-top:2px;
		padding-left:35px;
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
.message{
	width: 350px;
	height: 104px;
}

.maxpl{

	width:350px;
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