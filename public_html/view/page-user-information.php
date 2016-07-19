<?php
require('layout/header.php');


if($user->is_logged_in() )
{
	$query = "SELECT * FROM user WHERE id = '".$_SESSION['id']."'";
	$sql = mysql_query($query);
	$assoc = mysql_fetch_assoc($sql);


	if (isset($_POST['modify'])) {

		$username = htmlentities($_POST['username'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


	 	$sql1 = "SELECT * FROM user WHERE email = '".$_POST['email']."' ";
	 	$query1 = mysql_query($sql1);
	 	$row1 = mysql_num_rows($query1);
		
		if(strlen($username) < 3){
			$error = 'Usuario muy corto.';
		}	
		
		elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) { 
	     $error = 'El usuario tiene caracteres no validos.';
	    }else{

			$username = $_POST['username'];
			$name =(isset($_POST['name']))?$_POST['name']: ""; 
			$lastname = (isset($_POST['lastname']))?$_POST['lastname']: ""; 
			$security_question =(isset($_POST['security_question']))?$_POST['security_question']: "";
			$security_answer =(isset($_POST['security_answer']))?$_POST['security_answer']: "";
			$img_path = (isset($_POST['url_img']))? $_POST['url_img']:'';
			$userinfo = ModifyUser($username,$email,$name,$lastname,$security_question,$security_answer,$img_path);
			if (is_a($userinfo, 'errorCodes')) {
				$errors = $userinfo->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else{
			
				header('Location: /account/');
			}
			
		}
	}else  if (isset($_POST['modifypass'])){
	
	if(!isset($_POST['password']) || empty($_POST['password']))
	{
		$error = 'Password is require.';
			
	}

	if(!isset($_POST['retrypassword']) || empty($_POST['retrypassword']))
	{
		$error = 'Retry-Password is require.';
			
	}
	
	if($_POST['password']!=$_POST['retrypassword'])
	{
		$error = 'Passwords does not match.';
	}
	$username = $_SESSION['username'];
	$password	=$_POST['password'];
		if(!isset($error))
		{	
			$userinfo = ChangePasswordUser($username,$password);
			if (is_a($userinfo, 'errorCodes')) {
				$errors = $userinfo->GetErrors();
				echo "<p>type Error</p>";
				foreach($errors as $error)
				{
					echo "<p>type Error".$error."</p>";
				}
			}else
			{
				$error = 'Passwords change successful.';
			}
		}
		

}
	
	$userinfo = new userInfo($_SESSION['username']);
	if(isset($userinfo->user_id))
	{
		$username = $userinfo->user_username;
		$email = $userinfo->user_email;
		$name = $userinfo->user_name;
		$img = $userinfo->user_img;
		$lastname = $userinfo->user_lastname;
		$status = $userinfo->user_status;
		$security_question =$userinfo->user_security_question;
		$security_answer  =$userinfo->user_security_answer;
	}else{
		die("User Does Not Exist");
	}

}

?>

<div id="content">
<form method="post" action="">
<div  style="background-image: url('/image/botonera-sola-1024-x-66.png');margin-bottom:10px;background-size:100% 100%; margin-top: -1px;">

<div class="row">	
	<div class="col-xs-3 col-md-2" >
		<a href='/account/'>
		<p>back</p>
		</a>
	</div>
	
	
	<div class="col-xs-6 col-md-9" >
		<p></p>
	</div>
					
	<div class="col-xs-3 col-md-1" style="text-align:center">
	<input type="submit" name="modify" value="done" style="text-align: center;height: 20px; background-color: transparent; border-width: 0px; color: white; cursor: pointer;"> 
	</div>
	</div>
</div>	

	<?php 
if(isset($error))
{
	echo '<p>'.$error.'</p>';
}
?>
		<div class="row">
					
					<div class="col-xs-6 col-md-6" style="text-align:right">
						<div class="images_holder" style="padding-left: 0px;"> 
							<div class="upload_container_inner">
							<ul id="lista-imagenes" class="uploader_lista-imagenes">
								<?php
									if($img !="")
									{
									?>
										<div class="uploader_clasethumb" style="background: transparent url('<?php echo $img;?>') no-repeat scroll 0% 0% / 100% 100%;"></div>
										<input id="url_img" type="hidden" name="url_img" value="'<?php echo $img;?>'">
									<?php
									}
								
								?>
							</ul>
							</div>
						<div class="upload_container_input">
							<input id="testinput" class="uploader_hidden" type="file" name="pic" accept="image/*">
						</div>
						<div class="upload_container_crop_controls">
							<div id="cortar" class="uploader_modalDialog">
								<div id="inSide">
									<div id="modimagencont"></div>
									<div id="divMod" style="clear: both;"></div>
									<div id="progreso" class="uploader_progresoCont">
										<div class="uploader_barra">
											<div id="uploader_progreso" class="uploader_progreso" style="width: 100%;"></div>
										</div>
									</div>
								</div>
							</div>
							<input id="x" type="hidden" name="x" value="0">
							<input id="y" type="hidden" name="y" value="0">
							<input id="w" type="hidden" name="w" value="200">
							<input id="h" type="hidden" name="h" value="200">
							<input id="src" type="hidden" name="src" value="/tmp/2016-0714-Rci6-KZGW-wallet.jpg">
						</div>
					</div>
					</div>
					<div class="col-xs-6 col-md-6" style="text-align:left">
						<p class="fontsize_2" style="margin-top: 55px;font-weight: bold;"><?php if(isset($username)){ echo $username; }?></p>
						<p class="fontsize_4">Your Code: Manuel001</p>
						<input type="hidden" name="username" class="input_text_form"  id="username"  value="<?php if(isset($username)){ echo $username; } ?>" readonly>
						<input type="hidden" name="name" class="input_text_form"  id="name"   value="<?php if(isset($name)){ echo $name; } ?>" >
							  	 
					</div>
				</div>
				
						
					<input type="hidden" name="status" class="input_text_form"  id="status"  value="<?php if(isset($status)){ echo $status; } ?>" readonly>
							
					<div class="row" style="text-align:left;border-color:gray;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;"> 
						<div class="col-xs-0 col-md-4 maxp" >
						</div>
						<div class="col-xs-12 col-md-4 maxp" >
							<p class="fontsize_4"><img src="/image/Sobre-28-x-19.png" style="margin-right: 10px;" width="28" height="19" tittle="Password"><?php if(isset($email)){ echo $email; } ?></p>
						</div>
						 <input type="hidden" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
					</div>
					
					
					<div class="row" style="text-align:left;border-color:gray;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;"> 
						<div class="col-xs-0 col-md-4 maxp" >
						</div>
						<div class="col-xs-12 col-md-4" >
						<p class="fontsize_4 maxp color:black"><img src="/image/telf-28-x-29.png" style="margin-right: 10px;"  width="28" height="29" tittle="Password">+1305-456-7898</p>
						</div>
						 <input type="hidden" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
					</div>
					
					<div class="row" style="text-align:left;border-color:gray;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;">
						<div class="col-xs-0 col-md-4 maxp" >
						</div>
						<div class="col-xs-12 col-md-4" >
							<p class="fontsize_4" style="line-height:20px"><img src="/image/candado-23-x-29.png" style="margin-right: 10px;" width="23" height="29" tittle="Password"><span class="fontsize_5">******</span> Change Your Password</p>
							<input type="hidden" name="password" class="input_text_form"  id="password"   value="" >
							   <input type="hidden" name="retrypassword" class="input_text_form"  id="retrypassword"   value="" >
						</div>
					</div>
					
					<div class="row" style="text-align:left;border-color:gray;margin-bottom: 5px; border-width: 0px 0px 1px; border-style: solid;"> 
						<div class="col-xs-0 col-md-4 maxp" >
						</div>
						<div class="col-xs-12 col-md-4" >
						<p class="fontsize_4"><img src="/image/Gender.png" tittle="Gender" style="margin-right: 10px;" width="29" height="29">Gender</p>
						</div>
						 <input type="hidden" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
					</div>
				<hr style="border-color:black">
				
				<div class="row" style="text-align:left"> 
						<div class="col-xs-0 col-md-4 maxp" >
						</div>
						<div class="col-xs-12 col-md-4 fontsize_5" >
						<p class="fontsize_4">I want to be contact by:</p>
						 <input type="radio" name="contactby" value="Email" checked>Email
						 <input type="radio" name="contactby" value="Text" disabled>Text Message
						  <input type="radio" name="contactby" value="Text" disabled>Call<br>
						</div>
						 <input type="hidden" name="email" class="input_text_form"  id="email"   value="<?php if(isset($email)){ echo $email; } ?>" >
					</div>
					
					
				</form>
</div>
<div class="row div_input_principal"  style="color:blue; text-align: center; ">
	<div class="col-xs-12 col-md-12">
		<p class="fontsize_4 p_button" >
			<img  class="botonera_button_principal" src="/image/logo-botonera-111-x-173.png">
		</P>
	</div>	
</div>
<script>
	$(document).ready(function() {
	
	$('#lista-imagenes').click(function() {
	HandleUploadClick(); 
	});
		
	$('#testinput').change(function() {
	addFile();
	this.value=null;
	return false;
	});
	 
	
});

function borrarBarras(){
	$( ".progresoCont" ).empty();
}
function HandleUploadClick(){
    var clickHandle = document.getElementById("testinput");
    clickHandle.click();
}
function showCoords(c){
	$('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
}
function addFile(){
	location.href = "#cortar";
	var file = document.getElementById('testinput').files[0];
	if ((/\.(jpg|png|gif|jpeg)$/i).test(file.name)) {
	if (file.size < 1024 * 1024 * 2) {
	if($('#progreso').length)
	{
		progresss = document.getElementById('uploader_progreso');
	}else
	{
	var progresss = document.createElement('div'); 
		progresss.className = "uploader_progreso";
		progresss.id = "uploader_progreso";
    var progressBarr = document.createElement('div'); 
		progressBarr.className = "uploader_barra";
		progressBarr.appendChild(progresss);
	var progreso = document.createElement('div');
		progreso.id = "progreso";
		progreso.className = "uploader_progresoCont";
		progreso.appendChild(progressBarr);
	var inSide = document.getElementById('inSide');
		inSide.appendChild(progreso);
	}
	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append('file', file);
	xhr.open('POST', '/execution/fileuploader/');
	xhr.upload.onprogress = function (e) {
		
	if (e.lengthComputable) {	
		progresss.style.width=(e.loaded/e.total)*100+"%"; 
		}
	}
	xhr.upload.onloadstart = function (e) {
		$(".barra").value = 0;
	}
	xhr.upload.onloadend = function (e) {
		$(".barra").value = e.loaded;
	}
	xhr.onreadystatechange = function() {
	 if (xhr.readyState == 4 && xhr.status == 200) {
		borrarBarras(); 
		 if (xhr.responseText.substring(0, 5) != "Error") { 
			 $('#modimagencont').html('<img src="' + xhr.responseText + '" id="modimagen">');
			 $('.jcrop-holder').remove();
			 $('#modimagen').Jcrop({
             	bgColor: 'transparent',
				addClass: 'jcrop-centered',
				onSelect: showCoords,
           	 	onChange: showCoords,
				aspectRatio: 1,
			    setSelect: [ 0, 0,100, 100 ],
				minSize: [ 50,50 ],
				maxSize: [ 200,200 ]
        	 },function(){
				jcrop_api = this;
             });
			 $('#src').val(xhr.responseText);
			var divCortar = document.createElement('div'); 
				divCortar.className = ('uploader_guardar');	
				divCortar.innerHTML = ('Save');
				divCortar.addEventListener('click', function(e) {  			    
					cropFile();
					}, false);
			var divCancelar = document.createElement('div'); 
				divCancelar.className = ('uploader_cancelar');	
				divCancelar.innerHTML = ('Cancel');
				divCancelar.addEventListener('click', function(e) {  
				     $.Jcrop('#modimagen').destroy();		
				 	 $('.jcrop-holder').remove();
					 $('#modimagencont').html("");
			         $('#divMod').html("");
					 location.href = "#close";	
					}, false);
			var divMod = document.getElementById('divMod'); 	
				divMod.appendChild(divCortar);
				divMod.appendChild(divCancelar);			 
		}
		}	
	}
	xhr.send(formData);
	} else { alert('Error, Image cant weight more than 2 mb'); }	
	} else { alert('Error, Invalid image file'); }
 }
 
function cropFile(){
	var x = document.getElementById('x').value;
	var y = document.getElementById('y').value;
	var w = document.getElementById('w').value;
	var h = document.getElementById('h').value;
	var src = document.getElementById('src').value;
	var ajaxData = "x="+ x +"&y="+ y +"&w="+ w +"&h="+h +"&imgurl="+src+"";
	 $.ajax({
         type: "POST",
         url: "/execution/filecrop/filecrop.php",
         data: ajaxData,
		 success: function(data){
		 
				AddImageUploader(data);
				$.Jcrop('#modimagen').destroy();	
				$('.jcrop-holder').remove();
				$('#modimagencont').html("");
				$('#divMod').html("");
				location.href = "#close";	
			}
    });
	
}

function AddImageUploader(path_url)
{
	var list = document.getElementById('lista-imagenes');
	$('#lista-imagenes').html("");
	var	row_img = document.createElement('li');	
	var upload_img  = document.createElement('div'); 
	upload_img.style.background = "url('"+ path_url +"')";
	upload_img.style.backgroundSize = "120px 120px";
	upload_img.style.backgroundRepeat ="no-repeat";
	upload_img.className = "uploader_clasethumb";
	row_img.appendChild(upload_img);
	list.appendChild(row_img);
		// add url value 
	var input_url = document.createElement('input'); 
	input_url.type = "hidden";
	input_url.id = "url_img";
	input_url.name = "url_img";
	input_url.value = "'"+ path_url +"'";
	row_img.appendChild(input_url);	
}

</script>
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


.maxp{
	.maxp{
	width:300px;
	margin:auto;
	}
}
.uploader_hidden{
	display:none !important;
}
.content_chat_div_1{
	padding-top: 90px; padding-bottom: 90px;
}

	.images_holder{
		width: 120px; display: inline-block;
	}
	
	#lista-imagenes{
		
		background-image: url("/image/No_image_available_125x132.png");
		background-size: 100% 100%;
		border-style: solid;
		border-width: 0px;
		border-radius: 100%;
		bottom: 0;
		height: 120px;
		list-style: outside none none;
		margin: 0;
		overflow: hidden;
		padding: 0;
		position: relative;
		top: 0;
		width: 120px;
	}
	
	.uploader_clasethumb{
		 border-width: 0px;
	}
	
	.upload_container_input{
		height: 0px;
		width: 0px;
	}
	
	

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

.botonera_button_principal{
	width:111px;
	height:176px;
	margin-top:0px;
 }
	.row_margin_20{
 margin-top:40px;
}
.maxp{
	width:400px;
}
}
</style>
<?php 
//include header template
require('layout/footer.php');
?>