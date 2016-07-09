<?php 
class shipment{

	public $shipment_item;
	public $shipment_id;
	public $shipment_code;
	public $shipment_status;
	public $shipment_message;
	public $shipment_title;
	public $shipment_address;
	public $shipment_user_from;
	public $shipment_user_to;
	public $shipment_create_date;
	public $shipment_last_mod_date;

	function __construct($shipment_code_,$especial = false) 
	{
	
		if($especial)
		{
			$sql = 'SELECT * FROM submit where code ="'.$shipment_code_.'" ';
		
		}else
		{
			$sql = 'SELECT * FROM submit where code ="'.$shipment_code_.'" and status !="Erased"';
		
		}
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		if($row = mysql_fetch_assoc($query))
		{
			$this->shipment_id = $row["id"];
			$this->shipment_code = $row["code"];
			$this->shipment_item = new item($row["id_item"]);
			$this->shipment_status = $row["status"];
			$this->shipment_message = $row["message"];
			$this->shipment_title = $row["title"];
			$this->shipment_address= $row["address"]; //lost   found
			$this->shipment_create_date = $row["create_date"];
			$this->shipment_last_mod_date = $row["last_mod_date"];
			$this->shipment_user_from = $row["id_user_send"];
			$this->shipment_user_to = $row["id_user_recived"];
			$sql = 'SELECT username FROM user where id ='.$this->order_user_from.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->shipment_user_from = new userInfo($row2["username"]);
			}
			$sql = 'SELECT username FROM user where id ='.$this->order_user_to.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->shipment_user_to =  new userInfo($row2["username"]);
			}
		}	
   }
}
?>