<?php 
if(!isset($_POST["chat_method"]))
{
  die("Access Denied");
}

if($_POST["chat_method"] == "view"){
	if(!isset($_POST["chat_code"]))
	{
		die("Access Denied");
	}
		$code_chat =  $_POST["chat_code"];
		$query = 'SELECT c.create_date as date, c.id as id,c.code as code , u.username as creator, u2.username as invited FROM chat c';
		$query = $query. ' LEFT JOIN user u  ON c.id_user_create = u.id ';
		$query= $query. ' LEFT JOIN user  u2  ON c.id_user_invited = u2.id ';
		$query= $query.'  where c.code="'.$code_chat.'" GROUP BY c.code';
		
		$sql = mysql_query($query) or die('error at try to access data' . mysql_error());
		$chat_id;
		$user_create;
		$user_invited;
		$chat_date;
		
		if($row = mysql_fetch_assoc($sql))
		{
			$chat_date = $row['date'];
			$chat_id = $row['id'];
			$user_create = $row['creator'];
			$user_invited = $row['invited'];
			
		}else{
			die("Chat Do not Exist");
		}	
		$query = 'SELECT * FROM chat_message where id_chat='.$chat_id.'';
		$sql = mysql_query($query) or die('error at try to access data' . mysql_error());
		$message = "";
		while($row = mysql_fetch_assoc($sql))
		{
			$time = strtotime($row['date']);
			$time = "( ".date('y', $time)."/".date('m', $time)."/".date('d', $time)."  ".date('h', $time).":".date('i', $time).")";
			$message = $message.$time."".$row['message']."<br>";
		}	
}else{
	die("Access Denied");
}
	

require('layout/header.php'); 
?>
<div id="content">
<div class="header_div_1">
	<div class="header_div_2">
		<div id="menu_button">
		</div>
		<div class="header_div_3 header_div_home">
			<h2 class="header_title_1">Chat View</h2>
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
		
			<div style="height: 20%; display: table; border-style: solid; color: white; border-width: 0px 0px 4px;">
				<div style="width:33.3333%; float:left">
					CREATOR: <?php echo $user_create; ?>
				</div>
				<div style="width:33.3333%; float:left">
					INVITED: <?php echo $user_invited; ?>
				</div>
				<div style="width:33.3333%; float:left">
					DATE: <?php echo $chat_date; ?>
				</div>
			</div>
			<div style="height: 80%; padding-bottom: 20px; padding-top: 20px;text-align: left; color:white;">
			<?php echo $message; ?>
			</div>
			
		
	</div>
	<div class="options_container_page">
					<div class="options_frame_page">
						<div class="option_container_page" >
							<a href="/chats/chats/">
								<input class="search_option_result option_back" type="button" name="modify" value="">
								<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
							</a>
						</div>
					</div>
	</div>
</div>
</div>

<?php 
//include header template
require('layout/footer.php');
?>