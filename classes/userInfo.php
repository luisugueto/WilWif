<?php 
class userInfo{
	public $user_id;
	public $user_email;
	public $user_username;
	public $user_name;
	public $user_lastname;
	public $user_status;
	public $user_security_question;
	public $user_security_answer;
	public $user_blocked;
	public $user_login_attemps;
	public $user_create_date;
	public $user_last_mod_date;
	public $user_rol_code;
	public $user_rol_slug;
	public $user_img;
	
	function __construct($user_username_,$especial = false) 
	{
		if($especial)
		{
			$sql = 'SELECT * FROM user where username ="'.$user_username_.'" ';
		
		}else
		{
			$sql = 'SELECT * FROM user where username ="'.$user_username_.'" and status !="Erased"';
		
		}
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		$row = mysql_fetch_array($query);

		if(mysql_num_rows($query)!=0)
		{
			$this->user_id = $row["id"];
			$this->user_username = $row["username"];
			$this->user_email = $row["email"];
			$this->user_name = $row["name"];
			$this->user_lastname = $row["lastname"];
			$this->user_status= $row["status"]; 
			$this->user_security_question = $row["security_question"];
			$this->user_security_answer = $row["security_answer"];
			
			$this->user_blocked = $row["blocked"];
			$this->user_login_attemps = $row["login_attemps"];
			$this->user_create_date = $row["create_date"];
			$this->user_last_mod_date = $row["last_mod_date"];
			$this->user_rol_code = $row["rol_id"];
			$sql = 'SELECT slug,code FROM rol where id ='.$this->user_rol_code.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->user_rol_slug = $row2["slug"];
				$this->user_rol_code = $row2["code"];
			}
			
			$this->user_img ='';
			$sql = 'SELECT path FROM user_photo where id_user ='.$this->user_id.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->user_img = $row2["path"];
			}
		}	
	
	}
	
}
?>