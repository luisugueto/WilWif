<?php 
class item{

  public $item_id;
  public $item_code;
  public $item_name;
  public $item_description;
  public $item_country;
  public $item_city;
  public $item_address;
  public $item_title;
  public $item_status;
  public $item_type;
  public $item_user_id;
  public $item_user;
  public $item_photos_url;
  public $item_category_id;
  public $item_category_slug;
  public $item_date;
  public $item_color;
  public $item_brand;
  public $item_model;
  public $item_number;
   
  function __construct($item_code_,$especial = false) {
	
		if($especial)
		{
			$sql = 'SELECT * FROM item where code ="'.$item_code_.'" ';
		
		}else
		{
			$sql = 'SELECT * FROM item where code ="'.$item_code_.'" and status !="Erased"';
		
		}
		$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
		if($row = mysql_fetch_assoc($query))
		{
			$this->item_id = $row["id"];
			$this->item_code = $row["code"];
			$this->item_name = $row["name"];
			$this->item_description = $row["description"];
			$this->item_address = $row["findlost_address"];
			$this->item_title = $row["title"];
			$this->item_type = $row["type"]; //lost   found
			$this->item_country = $row["country"];
			$this->item_city = $row["city"];
			$this->item_status = $row["status"];
			$this->item_date = $row["create_date"];
			$this->item_category_id  = $row["id_category"];
			
			$this->item_color  = $row["color"];
			$this->item_brand  = $row["brand"];
			$this->item_model  = $row["model"];
			$this->item_number  = $row["number"];
			$sql = 'SELECT slug FROM item_category where id ='.$this->item_category_id.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if($row2 = mysql_fetch_assoc($query))
			{
				$this->item_category_slug = $row2["slug"];
			}
			
			$this->item_photos_url = array();
			$sql = 'SELECT path FROM item_photo where id_item ='.$this->item_id.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			if (mysql_num_rows($query)>0) 
			{
				while($row2 = mysql_fetch_assoc($query))
				{
					array_push($this->item_photos_url, $row2["path"]);	
				}
			}
			$this->item_user_id = $row["id_user"];
			$sql = 'SELECT username FROM user where id ='.$this->item_user_id.'';
			$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
			while($row2 = mysql_fetch_assoc($query))
			{
				$this->item_user = $row2["username"];
				
			}
			
			
		}else{
		
		}	
   }
   
   function HasPhoto()
   {
		if (!empty($this->item_photos_url)) {
			return true;
		}
		return false;
   }
   
   
}
?>