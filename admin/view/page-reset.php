<?php 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
	
		$query = "SELECT email,username FROM user WHERE email = '".$_POST['email']."' ";
		$sql = mysql_query($query);
		if($row = mysql_fetch_assoc($sql))
		{
			$username = $row['username'];
			$email = $row['email'];
			if(RecoverPasswordEmployee($username,$email)){
				header('Location: /');
			}else{
			$error[] = 'Error trying to change password.';
			}
			
		}else{
			$error[] = 'Invalid e-mail';
		}
	

	}
}

//define page title
$title = 'Reset Account';

//include header template
require('layout/header.php');
?>
<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png');">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-4">	
		<a href='/login/'>
			<p class="fontsize_4" style="margin-bottom: 0px;">back</p></a>
		</div>
		<div class="col-xs-4">	
			<img style="margin-top: 2%; margin-bottom: 3%;" src="/image/Logotipo-110-x-32.png" title="logo" width="110" height="32" >
		</div>
		<div class="col-xs-4">
		
		</div>
	</div>
</header>
<div id="content">

	<?php 
if(isset($error)){
echo '<p class="bg-danger">'.$error.'</p>';
				}
?>
<div class="row"  style="">

            <div class="col-xs-12" style=" margin-top:60px">
				<img src="/image/logo-187-187.png" title="logo" width="187" height="187" >
			</div>
</div>
<form  method="post" action="" autocomplete="off">
<div class="row"  style="">
	<div class="col-xs-12 col-md-12" style=" margin-top:20px;color:white">
		<p class="fontsize_4 maxpl">Shortly you will receive an email</p>
		<p class="fontsize_4 maxpl">confirmation with your new password</p>
	</div>
</div>
<div class="row"  style="">
	<div class="col-xs-12 col-md-12" >
		<input type="text" name="email" class="label_text_input"  id="email" placeholder="Email" value="<?php if(isset($username)){ echo $username; } ?>">
	</div>
</div>
<div class="row"  >
	<div class="col-xs-12 col-md-12" >
		<p class="maxpr">
		<input class=" fontsize_2"  style="margin-bottom: 40px; height: 35px; background-color: transparent; border-width: 0px; color: white;" type="submit" name="submit" value="Reset">
		</p>	
	</div>
</div>
				
</form>
</div>

<style>

.label_text_input{
		width: 300px;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
		
	}


.maxpl{
	width:300px;
	text-align:left;
	margin:auto;
}




.maxpc{
	width:300px;
	text-align:center;
	margin:auto;
}

.maxpr{
	width:300px;
	text-align:right;
	margin:auto;
}

.submit_login{
	color:white;
	background-color: transparent;
	border-width: 0px;

}
.label_email_input{
		border-color: black;
		width: 300px;
		height: 40px;
		border-width: 2px;
		padding-bottom: 1px;
		text-align:left;
		margin-bottom:5px;
		padding-left: 50px;
		border-style: solid;
		height: 49px;
		
	}
	
	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {
.label_email_input{
	height:53px;
	min-width:430px;
	max-width:430px;
	padding-left:60px;
}

.label_text_input{
	width: 430px;
	}
	
.maxpl{
	width:430px;
}

.maxpc{
	width:430px;
}

.maxpr{
	width:430px;
}
}	
</style>


<?php 
//include header template
$actualpage = "Recover Password";
require('layout/footer.php');
?>