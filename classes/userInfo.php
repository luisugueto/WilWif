<?php 
class userInfo{
	$user_id;
	$user_email;
	$user_username;
	$user_name;
	$user_lastname;
	$user_rol;
	$user_status;
	$user_security_question;
	$user_blocked;
	$user_login_attemps;
	$user_create_date;
	$user_last_mod_date;
	
	function __construct($user_username_,$especial = false) 
	{
		if($especial)
		{
			$sql = 'SELECT * FROM user where username ="'.$order_code_.'" ';
		
		}else
		{
			$sql = 'SELECT * FROM user where username ="'.$order_code_.'" and status !="Erased"';
		
		}
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		if($row = mysql_fetch_assoc($query))
		{
			$this->user_id = $row["id"];
			$this->user_username = $row["username"];
			$this->user_email = new item($row["email"]);
			$this->user_name = $row["name"];
			$this->user_lastname = $row["lastname"];
			$this->user_status= $row["status"]; 
			$this->user_security_question = $row["security_question"];
			$this->user_blocked = $row["blocked"];
			$this->user_login_attemps = $row["login_attemps"];
			$this->user_create_date = $row["create_date"];
			$this->user_last_mod_date = $row["last_mod_date"];
			
			$this->user_rol = $row["rol_id"];
			$sql = 'SELECT slug FROM user where id ='.$this->user_rol.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->user_rol = $row2["slug"];
			}
		}	
	
	}
	
}
?>