<?php 
//include header template
require('layout/header.php'); 
?>

<header class="header_container" style=" background-image: url('/image/botonera-sola-1024-x-66/png');height:100px">
	<div class="row"  style="border-width: 0px 0px 3px; border-style: solid; border-color: white; line-height:49px">
		<div class="col-xs-4">	
		<a href='/logout/'>
			<p class="fontsize_4" style="margin-bottom: 0px;">logout</p></a>
		</div>
		<div class="col-xs-4">	
			<img style="margin-top: 2%; margin-bottom: 3%;" src="/image/Logotipo-110-x-32.png" title="logo" width="110" height="32" >
		</div>
		<div class="col-xs-4">
		
		</div>
	</div>
</header>
<div id="content">
	<div class="row">
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/account/">
				<img class="admin_home_account" src="/image/Account-Icon-79-x-96.png">
				<p>Account</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/chats/">
				<img class="admin_home_chat" src="/image/Chats.png">
				<p>Chats</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/configurations/">
				<img class="admin_home_configuration" src="/image/Configuration-Icon-97-x-95.png">
				<p>Configurations</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/employees/">
			
			<img class="admin_home_employee" src="/image/Employee-Icon-87-x-97.png">
			<p>Employees</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/items/found/">
				<img class="admin_home_item" src="/image/Items-Icon-94-x-94.png">
				<p>Items</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/notifications/">
				<img class="admin_home_notifications" src="/image/Category-Icon-97-x-97.png">
				<p>Notifications</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu" >	
			<a href="/shipments/">
				<img class="admin_home_shipment" src="/image/Plane-97-x-97.png">
				<p>Shipments</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/records/">
				<img class="admin_home_record" src="/image/record-Icon-97-x-97.png">
				<p>Record</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/orders/">
				<img class="admin_home_order" src="/image/Category-Icon-96-x-96.png">
				<p>Order</p>
			</a>
		</div>
		<div class="col-xs-4 col-md-3 option_menu">	
			<a href="/users/">
				<img class="admin_home_user" src="/image/Security-Icon-96-x-96.png">
				<p>User</p>
			</a>
		</div>
	</div>

</div>
<style>
.option_menu{
height:150px;
}

.admin_home_account{
		width:40px;
		height:48px;
}

.admin_home_chat{
	width:48px;
	height:48px;
}

.admin_home_configuration{
	width:48px;
	height:47px;
}

.admin_home_employee{
	width:43px;
	height:48px;
}

.admin_home_item{
	width:47px;
	height:47px;
}

.admin_home_notifications{
	width:48px;
	height:48px;
}


.admin_home_shipment{
	width:47px;
	height:47px;
}

.admin_home_record{
	width:47px;
	height:47px;
}


.admin_home_order{
	width:48px;
	height:48px;
}


.admin_home_user{
	width:48px;
	height:48px;
}


	/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) {

	.admin_home_account{
		width:79px;
		height:96px;
}

.admin_home_chat{
	width:97px;
	height:97px;
}

.admin_home_configuration{
	width:97px;
	height:95px;
}

.admin_home_employee{
	width:87px;
	height:97px;
}

.admin_home_item{
	width:94px;
	height:94px;
}

.admin_home_notifications{
	width:97px;
	height:97px;
}


.admin_home_shipment{
	width:97px;
	height:97px;
}

.admin_home_record{
	width:97px;
	height:97px;
}


.admin_home_order{
	width:96px;
	height:96px;
}


.admin_home_user{
	width:96px;
	height:96px;
}
}
</style>
<?php 
//include header template
$actualpage="Home";
require('layout/footer.php');
?>