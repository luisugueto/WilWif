<?php
if(isset($_POST["chatmethod"]))
{
	session_start();
	$db=mysql_connect("localhost","root","");
	mysql_select_db("ap_chattest",$db);
	$method = $_POST["chatmethod"];
}else{
	die();
}
if($method == "read")
{
	if(isset($_SESSION['id']))
	{
		$id_user = $_SESSION['id'];
		$sql = 'SELECT id,message,date,status,id_user FROM chat_message where id_chat in';
		$sql = $sql.'(select id from chat where code="'.$_POST['chatcode'].'" and ((id_user_invited='.$id_user.') or (id_user_create='.$id_user.')))';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());

		$message = "";
		$newchat = false;
		while($row = mysql_fetch_assoc($query))
		{
			$time = strtotime($row['date']);
			$time = "(".date('h', $time).":".date('i', $time).")";
			$message = $message.$time."".$row['message']."<br>";
			if($row['status'] == "unread" && $id_user != $row['id_user'])
			{
				$newchat = true;
				$sql = "UPDATE chat_message SET";
				$sql = $sql." status = 'read'";
				$sql = $sql." WHERE id =".$row['id']; 
				mysql_query($sql)or die('error at try to access data' . mysql_error());
			}
		}
		$message = $message."<br>";
		$arrayJson = array( 'message' => $message,'success' => true,'newdata' => $newchat , 'isonline' => false);
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
		$sql = 'SELECT id,code FROM chat where id in';
		$sql = $sql. ' (SELECT id_chat from chat_message where';
		$sql = $sql. ' id_chat in (SELECT id FROM chat where ((id_user_invited='.$id_user.') or (id_user_create='.$id_user.')) '.$stringchatcodes.')';
		$sql = $sql. ' and status="unread" and id_user !='.$id_user.')';
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$chats = array();
		$newchat = false;
		while($row = mysql_fetch_assoc($query))
		{
			$newchat = true;
			array_push($chats, $row['code']);
			$sql = "UPDATE chat_message SET";
			$sql = $sql." status = 'read'";
			$sql = $sql." WHERE id_chat =".$row['id']; 
		}
		$arrayJson = array( 'row' => $chats,'success' => true,'newdata' => $newchat , 'isonline' => true , 'username' => 'Admin' );
		echo json_encode($arrayJson);
		die();
	}
}else if ($method == "write"){
	if(isset($_SESSION['id']))
	{
		$id_user = $_SESSION['id'];
		if(!isset($_POST["chatcode"]) || !isset($_POST["text"]))
		{
			die();
		}
		$code_chat = $_POST['chatcode'];
		$text = $_POST['text'];
		$text =" <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text));
		$sql =  'INSERT INTO chat_message (';
		$sql =  $sql. 'id_user' ;
		$sql =  $sql. ',message' ;
		$sql =  $sql. ',id_chat' ;
		$sql =  $sql. ',date' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. ''.$id_user.'' ;
		$sql =  $sql. ',"'.$text.'"' ;
		$sql =  $sql. ',(select id from chat where code ="'.$code_chat.'")';
		$sql =  $sql. ', NOW()' ;
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
		$code_chat = date("Y").'-'.date('m').date('d').'-';
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			for ($i = 0; $i < 8; $i++) 
			{
				$code_chat = $code_chat.$characters[rand(0, strlen($characters))];
				if($i == 3)
				{
					$code_chat = $code_chat.'-';
				}
			}
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
		
		$arrayJson = array('success' => true, 'chatcode' => $code_chat , 'username' => 'Admin');
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
		$chatcode = $_POST["code_chat"];
		$sql = 'SELECT code FROM chat where code="'.$chatcode.'"';
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
		
		if($row = mysql_fetch_assoc($query))
		{
			$code_chat = $row["code"];
		}
		$arrayJson = array('success' => true, 'chatcode' => $code_chat , 'username' => 'Admin');
		echo json_encode($arrayJson);
		die();
	}
}else die();
?>