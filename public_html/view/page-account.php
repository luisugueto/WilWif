<?php 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Inicio';

//include header template
require('layout/header.php'); 
?>
<!-- <div id="main-area">
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
        
</div> -->
<div align="center">
    <div class="contenedorLogin" style="padding-bottom: 20px; width: 800px ">
        <input class="img-account-info" type="submit" value="" onclick="window.location.href='info'">
        <input class="img-account-found-items" type="submit" value="" onclick="window.location.href='found-items'">
        <input class="img-account-lost-items" type="submit" value="" onclick="window.location.href='lost-items'">
        <input class="img-account-orders" type="submit" value="" onclick="window.location.href='found-orders'">
        <input class="img-account-notifications" type="submit" value="" onclick="window.location.href='notifications'">
        <input class="img-account-submits" type="submit" value="" onclick="window.location.href='shipments'">

    </div>
</div>
<?php 
//include header template
require('layout/footer.php'); 
?>
