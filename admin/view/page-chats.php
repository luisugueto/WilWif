<?php 
//include header template
require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		
		</div>
		<div class="header_div_3 header_div_home">
			<h1 class="header_title_1">Chats</h1>
		</div>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
		<?php require('layout/menu.php'); ?>
	</div>
</div>
<div id="content_containter">
	<div class="content_chat_div_1">
		<div class="div_inline-block">
			<div class="chat_option">
				<a href="/chats/chats/" title="Configurations">
					<div id="home_config_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Chats</h2>
				</div>
			</div>
			<div class="chat_option">
				<a href="/chats/users" title="Chats">
					<div id="home_chat_div" class="home_div">
					</div>
				</a>
				<div>
					<h2 class="margin_top_0">Users Online</h2>
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
</div>
<style>

</style>
<?php 
//include header template
require('layout/footer.php');
?>