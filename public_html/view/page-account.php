<?php 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Inicio';

//include header template
require('layout/header.php'); 
?>
<div id="content">
<div  style="height: 112px; background-image: url('/image/header2-1440-112.png'); background-repeat: no-repeat; background-size: 100% auto; width: 100%;">
	<div style="width: 1440px; display: inline-block; text-align: left;">
		<form style="height: 0px; float: right;">
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="float: right; border-width: 0px; margin-top: 10px; background-image: url('	/image/barra-generica-478-47.png'); background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 70px; padding-left: 90px; width: 386px; height: 51px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	
	

<div id="main-area">
	<div id="main-content-bg">
    	<div id="main-content" style="display:table;">
        	<div style="display:table-cell; vertical-align:middle;">
        	<a href="info"><div class="item img-shadow"><img style="margin-right:40px;" class="img-shadow" src="../image/icono_info_21x39.png" width="21px" height="39px" />Account info</div></a>
            <a href="found-items"><div class="item img-shadow"><img style="margin-right:40px;" class="img-shadow" src="../image/icono_encontrado_25x39.png" width="21px" height="39px" />Found articles</div></a>
            <a href="lost-items"><div class="item img-shadow"><img style="margin-right:40px;" class="img-shadow" src="../image/icono_perdido_39x39.png" width="21px" height="39px" />Lost articles</div></a>
            <a href="shipments"><div class="item img-shadow"><img style="margin-right:40px;" class="img-shadow" src="../image/icono_enviado_23x38.png" width="21px" height="39px" />Send articles</div></a>
            </div>
        </div>
    </div>
</div>


	</div>
</div>
<?php 
//include header template
require('layout/footer.php'); 
?>
