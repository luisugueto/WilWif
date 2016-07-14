<?php
require('layout/header.php');

if(isset($_GET['id'])) { $id = $_GET['id']; }
$query = "SELECT * FROM item";
$sql = mysql_query($query);
$sql_row = mysql_num_rows($sql);

######### PAGINACIONN ###############
$nregistros = 4;
$nfilas = mysql_num_rows($sql);
$numpags = $nfilas / $nregistros;
if (isset($_POST['pagina']))	$npagina = $_POST['pagina']; else $npagina = 1;

$query .= " LIMIT ".((($npagina*$nregistros)-($nregistros-1))-1).", ".$nregistros;
$resultado = mysql_query($query);
$rows = mysql_num_rows($resultado);

############################################


$type = 'i';
if (isset($_POST['view'])) {
	$type = 'v';
	$code = $_POST['code'];
}
elseif(isset($_POST['block'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Block' WHERE code = '".$code."'");
	header('Location : /items/');
}	
elseif(isset($_POST['unlock'])){
	$code = $_POST['code'];
	$query = mysql_query("UPDATE item SET status = 'Unlock' WHERE code = '".$code."'");
	header('Location : /items/');
}

?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_item">
			<h1 class="header_title_1">Items</h1>
		</div>
	</div>
</div>
	
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter" >
		
		<div class="content_chat_div_1">
		<div class="div_inline-block">
			<div class="chat_option">
				<a href="/items/found/" title="Configurations">
					<div id="home_config_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Found Items</h2>
				</div>
			</div>
			<div class="chat_option">
				<a href="/items/lost/" title="Chats">
					<div id="home_chat_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Lost Items</h2>
				</div>
			</div>
			
		</div>
	</div>
	<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
					</div>
	</div>
</div>

<?php 
//include header template
require('layout/footer.php');
?>