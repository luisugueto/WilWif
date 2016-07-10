<?php 
//include header template
require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div class="header_div_3 header_div_home">
			<h1 class="header_title_1">HOME</h1>
		</div>
	</div>
</div>
<div id="content_containter">
	<div class="content_div_1">
		<div class="div_inline-block">
			<div class="home_option">
				<a href="/configurations/" title="Configurations">
					<div id="home_config_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Configurations</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/chats/" title="Chats">
					<div id="home_chat_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Chats</h2>
				</div>
			</div>
			<div  class="home_option">
				<a href="/employees/" title="Employees">
					<div id="home_employee_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Employees</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/statistics/" title="Stadistics">
					<div id="home_stadistic_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Stadistics</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/records/" title="Record">
					<div id="home_record_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Record</h2>
				</div>
			</div>
			
			
			
			<div class="home_option">
				<a href="/items/" title="Items">
					<div id="home_item_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Items</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/shipments/" title="Shipments">
					<div id="home_shipment_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Shipments</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/notifications/" title="Notifications">
					<div id="home_notification_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Notifications</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/orders/" title="Orders">
					<div id="home_order_div" class="home_div" >
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Orders</h2>
				</div>
			</div>
			<div class="home_option">
				<a href="/users/" title="Users">
					<div id="home_user_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Users</h2>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<style>
.header_div_1
{
	height: 112px;
	background-image: url('/image/header2-1440-112.png');
	background-repeat: no-repeat;
	background-size: 100% auto;
	width: 100%;"

}
.header_div_2
{
	width: 1440px;
	display: inline-block;
	padding-right: 81px;
	padding-left: 221px;
	text-align: left;
}
.header_div_3
{
	background-repeat: no-repeat;
	height: 82px;
	display: inline-block;
	margin-left: 0px;
	margin-top: 15px;
	width: 540px;
	padding-left: 90px;
}

.header_div_home{
	background-image: url('/image/barra-home-534-78.png');
}
.header_title_1{
	height: 38px;
	color: white;
	width: 220px;
	font-family: arial,rial;
	margin-left: 83px;
}

#content_containter{
	margin-top: 50px;
	margin-bottom: 50px;
	width: 1440px;
	display: inline-block;
}

.content_div_1{
	display: inline-block;
	width: 1176px;
	height: 567px;
	background-image: url('/image/cuadro-home-1176-567.png');
	padding: 58px 54px 54px 58px;"
}

.div_inline{
	display: inline-block;
}

.home_option{
	height: 232px;
	width: 20%; 
	float: left;
	padding-top: 30px;
	color:white;	
}

.margin_top_0{
	margin-top: 0px;
}
</style>
<?php 
//include header template
require('layout/footer.php');
?>