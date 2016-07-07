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
	<div style="width: 1440px; display: inline-block; padding-right: 81px; padding-left: 221px; text-align: left;">
		<div style="background-image: url('/image/barra-account-534-78.png'); background-repeat: no-repeat; height: 82px; display: inline-block; margin-left: 0px; margin-top: 15px; width: 540px; padding-left: 90px;">
			<h1 style="height: 38px; color: white; width: 220px; font-family: arial,rial;margin-left: 83px;">Account</h1>
		</div>
		<form method="get" action="/" style="float: right; background-image: url('/image/barra-generica-478-47.png'); border-width: 0px; margin-top: 30px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 66px; padding-left: 0px; width: 386px; height: 51px;">
			<p style="float: left; width: 82px; padding-left: 17px; color: white; font-size: 20px; margin-top: 13px;">Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value" style="border-width: 0px; margin-top: 0px; background-color: transparent; background-repeat: no-repeat; background-size: 100% 100%; padding-top: 1px; padding-right: 0px; padding-left: 0px; height: 51px; float: left; width: 238px;">
		</form>
	</div>
</div>
<div id="content_containter" style="margin-top: 50px; margin-bottom: 50px; width: 1440px; display: inline-block;">
	
	
	
<div style="width: 760px; height: 508px; display: inline-block; background-color: rgba(096,111,140,0.3); border-radius: 50px;">
		<div style="display: inline-block; background-color: transparent; border-radius: 50px; height: 468px; width: 720px; border-style: solid; border-color: white; margin-top: 20px;">
			<div style="height: 232px; width: 25%; float: left; padding-top: 30px;color:white">
				<a href="/account/info/" title="Info">
					<div id="home_account_info_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Account Info</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left; padding-top: 30px;color:white">
				<a href="/account/found-items/" title="Found">
					<div id="home_account_found_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Found Items</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left; padding-top: 30px;color:white">
				<a href="/account/lost-items/" title="Lost">
					<div id="home_account_lost_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Lost Items</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left; padding-top: 30px;color:white">
				<a href="/account/requests/" title="Requests">
					<div id="home_account_request_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Request Items</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left; padding-top: 30px;color:white">
				<a href="/account/orders/" title="Orders">
					<div id="home_account_order_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Orders</h2>
				</div>
			</div>
			
			
			
			<div style="height: 232px; width: 25%; float: left;color:white;padding-top: 30px;" >
				<a href="/account/shipments" title="Shipments">
					<div id="home_account_shipments_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Shipments</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left;color:white;padding-top: 30px;">
				<a href="/account/notifications/" title="Notifications">
					<div id="home_account_notifications_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Notifications</h2>
				</div>
			</div>
			<div style="height: 232px; width: 25%; float: left;color:white;padding-top: 30px;">
				<a href="/account/help/" title="Help">
					<div id="home_account_help_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 style="margin-top: 0px;">Help</h2>
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
