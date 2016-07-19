<?php 
if(!isset($_POST["chat_method"]))
{
  die("Access Denied 1");
}

if($_POST["chat_method"] == "create")
{
	
	if(isset($_SESSION['id']))
	{
		if(!isset($_POST["user_invite"]))
		{
			die();
		}
		$invited_username = 'Admin';
		$id_user = $_SESSION['id'];
		$id_user_invited = $_POST["user_invite"];
		$code_chat = CreateCode();
		$sql =  'INSERT INTO chat (';
		$sql =  $sql. 'id_user_create' ;
		$sql =  $sql. ',id_user_invited' ;
		$sql =  $sql. ',code' ;
		$sql =  $sql. ',create_date' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. ''.$id_user.'' ;
		$sql =  $sql. ','.$id_user_invited.'' ;
		$sql =  $sql. ',"'.$code_chat.'"';
		$sql =  $sql. ', NOW()' ;
		$sql =  $sql. ')' ;
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());		
		$sql = 'SELECT * FROM user where id='.$id_user_invited.' and status !="Erased"';

		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$username = "";
		if($row = mysql_fetch_assoc($query))
		{
			$username = $row['username'];
		}	
	}
}else if($_POST["chat_method"] == "open"){
if(!isset($_POST["chat_code"]))
{
  die("Access Denied 2");
}
		$code_chat =  $_POST["chat_code"];
		$sql = 'SELECT id_user_invited FROM chat where code="'.$code_chat.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		
		if($row = mysql_fetch_assoc($query))
		{
			$id_user_invited = $row['id_user_invited'];
		}else{
			die("Chat Do not Exist");
		}	
		$sql = 'SELECT * FROM user where id='.$id_user_invited.' and status !="Erased"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$username = "";
		if($row = mysql_fetch_assoc($query))
		{
			$username = $row['username'];
		}	
}else if($_POST["chat_method"] == "view"){


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
			<h2 class="header_title_1">Chat with <?php echo $username; ?></h2>
		</div>
		<form class="form_search" method="get" action="/" >
			<p >Search</p>
			<input type="text" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; }?>" name="s" id="search_value">
		</form>
	</div>
</div>
<div>
	<div id="menu" class="menu_close">
	
	</div>
</div>
<div id="content_containter">
	
	<div id="chat_container">
	</div>
	<div class="options_container_page">
		<div class="options_frame_page">
			<div class="option_container_page" >
				<a href="/chats/">
					<input class="search_option_result option_back" type="button" name="modify" value="">
					<p style="width: 62px; margin-top: 0px; margin-bottom: 0px;">Return</p>
				</a>
			</div>
		</div>
	</div>
	
</div>
</div>
<script>

	function createClickEvent(chatContainer,inputsubmit,inputchatcode,inputmsg,chatbox,logout,chatMenu,chatc,chatMenuIcon,idchat)
	{	//If user click the menu bar
		//If user submits the form
		inputsubmit.click(function()
		{	
			var clientmsg = inputmsg.val();
			var chat = inputchatcode.val();
			inputmsg.val("");
			$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				data:'text='+clientmsg+'&chatcode='+idchat+"&chatmethod=write",
				datatype: 'json',
				success: function(data){
				},
			});
			return false;
		});
		
		//check if there are new msg 
		var refreshIntervalId = setInterval(function ()
		{ 
			var oldscrollHeight = chatbox.attr("scrollHeight") - 20; //Scroll height before the request
			$.ajax({
				method:"post",
				url: "/execution/zuaruchat/",
				cache: false,
				data:'chatcode='+idchat+"&chatmethod=read",
				dataType: 'json',
				success: function(data){		
					chatbox.html(data.message); //Insert chat log into the #chatbox div	
					
					if(data.isonline)
					{
						chatMenuIcon.addClass("online");
						chatMenuIcon.removeClass("offline");
					}else{
						chatMenuIcon.addClass("offline");
						chatMenuIcon.removeClass("online");
					}
					
					if(data.newdata)
					{	
						//Auto-scroll		
						chatbox.scrollTop(9999);
						if(chatc.hasClass( "message_container_close" ))
						{
							var colorIntervalId = setInterval(function ()
							{
								if(chatMenu.hasClass( "normal" ))
								{	
									chatMenu.addClass("alert");
									chatMenu.removeClass("normal");
								}else{
									chatMenu.addClass("normal");
									chatMenu.removeClass("alert");
								}
							}, 500);
							chatMenu.click(function()
							{	
								if(!chatMenu.hasClass( "normal" ))
								{	
									chatMenu.addClass("normal");
									chatMenu.removeClass("alert");
								}
								clearInterval(colorIntervalId);
							});
						}
						beep();
					}						
				},
			});
		}, 2500);
		
		
	}


	function addChat(chatCode,username)
	{
		var chatContainer = $("<div></div>");
		chatContainer.addClass( "chat_container");
		chatContainer.attr('id',"wrapper_"+chatCode);
		// menu
		var chatMenu = $("<div></div>");
		chatMenu.addClass("menu");
		chatMenu.addClass("normal");
						
		var chatMenuName = $("<p></p>");
		var chatMenuIcon = $("<div></div>");
		chatMenuName.addClass("welcome");
						
		var chatMenuIcon = $("<div></div>");
		chatMenuIcon.addClass("offline");
		chatMenuName.append( chatMenuIcon );
						
		var chatMenuNameBolt = $("<b> "+username+" </b>");
		chatMenuName.append( chatMenuNameBolt );
		chatMenuNameBolt.addClass("MenuName");
						
		var logout = $("<p></p>"); 
		logout.addClass("logout");
						
		var logoutIcon = $("<div></div>");
		logoutIcon.addClass("logouticon");
		logout.append( logoutIcon );
						
		chatMenuName.append( logout );
						
		var divmenu = $("<div style='clear:both'></div>"); 
						
		chatMenu.append( chatMenuName );
		chatMenu.append( logout );
		chatMenu.append( divmenu);
		chatContainer.append( chatMenu);
		//end menu
		//chatcointaner
		var chatc = $("<div></div>");
		chatc.addClass( "message_container");
		//chatbox
		var chatbox = $("<div></div>");
		chatbox.addClass( "chatbox");
		chatbox.attr('id',"chatbox_"+chatCode);
		chatc.append(chatbox);
		// end chatbox
		//form
		var form = $("<form name='message' action='/post.php' method='post'></form>");
						
		var inputmsg = $("<input name='usermsg' type='text' id='usermsg_"+chatCode+"' size='63' autocomplete='off'/>");
		inputmsg.addClass( "usermsg");
		var inputchatcode = $("<input name='chatcode' type='hidden' value="+chatCode+" class='chatcode' />");
		var inputsubmit = $("<input name='submitmsg' type='submit'  id='"+chatCode+"' value='    ' />");
		inputsubmit.addClass('submit');
		createClickEvent(chatContainer,inputsubmit,inputchatcode,inputmsg,chatbox,logout,chatMenu,chatc,chatMenuIcon,chatCode);
		form.append(inputmsg);
		form.append(inputchatcode);
		form.append(inputsubmit);
		chatc.append(form);
		//end form
		chatContainer.append(chatc);
		//chatcointaner
		$("#chat_container").append(chatContainer);
	}
	
	$(document).ready(function(){
	function createMsg()
	{
		addChat('<?php echo $code_chat?>',' <?php echo $username; ?>');
	}
	
	createMsg ();
});
</script>
<style>
#chat_container{
	width: 760px;
	display: inline-block;
}

.chat_container{
	width: 760px;
	background-image: url('/image/fondo-435-374.png');
	background-size: 100% 100%;
}

.chatbox{
	width: 720px;
	margin: auto;
	height: 360px;
	text-align: left;
}
.menu{
	width: 760px; 
}

.message_container{
	width: 760px;
	height: 401px;
	padding-top: 0px;
	margin: auto auto auto 0px;
}

.usermsg{
	width: 690px;
	height: 40px;
	background-image: url('/image/barra-reset-718-62.png');
	background-size: 100% 100%;
	position: relative;
	padding-left: 10px;
	padding-right: 10px;
	font-family: Times;
	font-size: 25px; 
	margin-top: -100px;
}

.logouticon{
	height: 60px; 
	background-image: url('/image/boton-cancelar-57-57.png');
	background-repeat: no-repeat;
	background-position: right;
	position: relative;
	margin-top: -50px;
}
.submit{
	width: 50px;
	height: 40px;
	background-image: url('/image/boton-seach-23-23.png');
	background-size: 100% 100%;
	border: 0px;
	border-radius: 50%;
}
.MenuName{
	color: white;
	font-size: 30px;
}
</style>
</style>
<?php 
//include header template
require('layout/footer.php');
?>