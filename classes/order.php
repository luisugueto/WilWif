<?php 
class order{

	public $order_item;
	public $order_id;
	public $order_code;
	public $order_status;
	public $order_message;
	public $order_title;
	public $order_address;
	public $order_user_from;
	public $order_user_to;
	public $order_create_date;
	public $order_last_mod_date;

	function __construct($order_code_,$especial = false) 
	{
	
		if($especial)
		{
			$sql = 'SELECT * FROM `order` where code ="'.$order_code_.'" ';
		
		}else
		{
			$sql = 'SELECT * FROM `order` where code ="'.$order_code_.'" and status !="Erased"';
		
		}
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		if($row = mysql_fetch_assoc($query))
		{
			$this->order_id = $row["id"];
			$this->order_code = $row["code"];
			$this->order_status = $row["status"];
			$this->order_message = $row["message"];
			$this->order_title = $row["title"];
			$this->order_address= $row["address"]; //lost   found
			$this->order_create_date = $row["create_date"];
			$this->order_last_mod_date = $row["last_mod_date"];
			$this->order_user_from = $row["id_user_send"];
			$this->order_user_to = $row["id_user_recived"];
			$sql = 'SELECT username FROM user where id ='.$this->order_user_from.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->order_user_from = new userInfo($row2["username"]);
			}
			$sql = 'SELECT username FROM user where id ='.$this->order_user_to.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->order_user_to =  new userInfo($row2["username"]);
			}
			
			$sql = 'SELECT code FROM item where id ='.$row["id_item"].'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->order_item = new item($row2["code"]);
			}
		}	
   }
}
?>