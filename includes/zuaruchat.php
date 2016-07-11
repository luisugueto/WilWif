<?php
/* 
Requeriments For this Chat to work
It use  mysql_  and need a preview con..
Table  Chat  [id,code,id_user_create,id_user_invited,create_date]
Table chat_message [id, date,message,status, id_user, code]
Table user   [id, username, last_mod_date]

*/
if(isset($_POST["chatmethod"]))
{
	$method = $_POST["chatmethod"];
}else{
	die();
}
if($method == "read")
{
	if(isset($_SESSION['id']) && isset($_POST['chatcode']))
	{
		$chatcode = $_POST['chatcode'];
		$id_user = $_SESSION['id'];
		$sql = 'SELECT id,message,date,status,id_user FROM chat_message where id_chat in';
		$sql = $sql.'(select id from chat where code="'.$chatcode.'" and ((id_user_invited='.$id_user.') or (id_user_create='.$id_user.')))';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());

		$message = "";
		$newchat = false;
		while($row = mysql_fetch_assoc($query))
		{
			$time = strtotime($row['date']);
			$time = "(".date('h', $time).":".date('i', $time).")";
			$message = $message.$time."".$row['message']."<br>";
			if($row['status'] == "Unread" && $id_user != $row['id_user'])
			{
				$newchat = true;
				$sql = "UPDATE chat_message SET";
				$sql = $sql." status = 'Read'";
				$sql = $sql." WHERE id =".$row['id']; 
				mysql_query($sql)or die('error at try to access data' . mysql_error());
			}
		}
		$message = $message."<br>";
		
		
		//$chatcode
		$sql = 'SELECT id_user_create,id_user_invited FROM chat where code="'.$chatcode.'"';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		if($row = mysql_fetch_assoc($query))
		{
			$chat_user_id;
			if($row['id_user_create'] == $_SESSION['id']){
				$chat_user_id =$row['id_user_invited'];
			}else{
				$chat_user_id =$row['id_user_create'];
			}
			
			$sql = 'SELECT username FROM user where id='.$chat_user_id.' and last_mod_date  > date_sub(now(), interval 1 minute) and status !="Erased"';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			$online = false;
			if($row = mysql_fetch_assoc($query))
			{
				$online = true;
			}	
		}	
		
		$arrayJson = array( 'message' => $message,'success' => true,'newdata' => $newchat , 'isonline' => $online);
		echo json_encode($arrayJson);
		die();
	}
}else if($method == "check")
{
	if(isset($_SESSION['id']))
	{
		$id_user = $_SESSION['id'];
		$stringchatcodes = "";
		if(isset($_POST['chatcodes'])){
		$chatcodes =  $_POST['chatcodes'];
		foreach ($chatcodes as $chatcode) {
			if($stringchatcodes != ""){
				$stringchatcodes = $stringchatcodes.",";
			}
			$stringchatcodes = $stringchatcodes."'".$chatcode."'";
		}
		$stringchatcodes = ' and code not in ('. $stringchatcodes.')';
		}
		$invited_username = 'Admin';
		$sql = 'SELECT id,code,id_user_create,id_user_invited FROM chat where id in';
		$sql = $sql. ' (SELECT id_chat from chat_message where';
		$sql = $sql. ' id_chat in (SELECT id FROM chat where ((id_user_invited='.$id_user.') or (id_user_create='.$id_user.')) '.$stringchatcodes.')';
		$sql = $sql. ' and status="Unread" and id_user !='.$id_user.')';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$chats = array();
		$usernames = array();
		$newchat = false;
		while($row = mysql_fetch_assoc($query))
		{
			$newchat = true;
			array_push($chats, $row['code']);
			$chat_user_id;
			if($row['id_user_create'] == $_SESSION['id']){
				$chat_user_id =$row['id_user_invited'];
			}else{
				$chat_user_id =$row['id_user_create'];
			}
			
			$sql = 'SELECT username FROM user where id='.$chat_user_id.' and status !="Erased"';
			$query2 = mysql_query($sql) or die('error at try to access data' . mysql_error());
			$username = "";
			if($row2 = mysql_fetch_assoc($query2))
			{
				array_push($usernames, $row2['username']);
			}else{
				array_push($usernames, '');
			}			
			
		}
		$arrayJson = array( 'row' => $chats,'success' => true,'newdata' => $newchat , 'isonline' => true , 'username' => $usernames );
		echo json_encode($arrayJson);
		die();
	}
}else if ($method == "write"){
	if(isset($_SESSION['id']) && isset($_SESSION['username']))
	{
		$id_user = $_SESSION['id'];
		$username =  $_SESSION['username'];
		if(!isset($_POST["chatcode"]) || !isset($_POST["text"]))
		{
			die();
		}
		$code_chat = $_POST['chatcode'];
		$text = $_POST['text'];
		$text =" <b>".$username."</b>: ".stripslashes(htmlspecialchars($text));
		$sql =  'INSERT INTO chat_message (';
		$sql =  $sql. 'id_user' ;
		$sql =  $sql. ',message' ;
		$sql =  $sql. ',id_chat' ;
		$sql =  $sql. ',date' ;
		$sql =  $sql. ',status' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. ''.$id_user.'' ;
		$sql =  $sql. ',"'.$text.'"' ;
		$sql =  $sql. ',(select id from chat where code ="'.$code_chat.'")';
		$sql =  $sql. ', NOW()' ;
		$sql =  $sql. ', "Unread"' ;
		$sql =  $sql. ')' ;

		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
		//Esto guarda el mensaje del chat 
		$arrayJson = array('success' => true);
		echo json_encode($arrayJson);
		die();
	}

}else if($method == "create")
{
	if(isset($_SESSION['id']))
	{
		if(!isset($_POST["user_invite"]))
		{
			die();
		}
		$id_user = $_SESSION['id'];
		$id_user_invited = $_POST["user_invite"];
		$code_chat = CreateCode();
		$sql =  'INSERT INTO chat (';
		$sql =  $sql. 'id_user_create' ;
		$sql =  $sql. ',id_user_invited' ;
		$sql =  $sql. ',code' ;
		$sql =  $sql. ',date' ;
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
		$invited_username = "";
		if($row = mysql_fetch_assoc($query))
		{
			$invited_username= $row['username'];
		}else{
			$invited_username= '';
		}
		
		
		$arrayJson = array('success' => true, 'chatcode' => $code_chat , 'username' => $invited_username);
		echo json_encode($arrayJson);
		die();
	}
}else if($method == "open")
{
	if(isset($_SESSION['id']))
	{
		if(!isset($_POST["code_chat"]))
		{
			die();
		}
		$invited_username = 'Admin';
		$chatcode = $_POST["code_chat"];
		$sql = 'SELECT code,id_user_invited,id_user_create FROM chat where code="'.$chatcode.'"';
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
		
		if($row = mysql_fetch_assoc($query))
		{
			$code_chat = $row["code"];
			$chat_user_id;
			if($row['id_user_create'] == $_SESSION['id']){
				$chat_user_id =$row['id_user_invited'];
			}else{
				$chat_user_id =$row['id_user_create'];
			}
			
			$sql = 'SELECT username FROM user where id='.$chat_user_id.' and status !="Erased"';
			$query2 = mysql_query($sql) or die('error at try to access data' . mysql_error());
			$invited_username = "";
			if($row2 = mysql_fetch_assoc($query2))
			{
				$invited_username = $row2['username'];
			}else{
				$invited_username = '';
			}	
			
			$arrayJson = array('success' => true, 'chatcode' => $code_chat , 'username' => $invited_username);
			echo json_encode($arrayJson);
			die();
		}else{
			die();
		}	
	}
}else die();
?>