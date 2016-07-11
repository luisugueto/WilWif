<?php

function UserAction()
{
	$sql = "UPDATE user SET";
	$sql = $sql." last_mod_date = now()";
	$sql = $sql." WHERE id=".$_SESSION['id']; 
	
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('item',mysql_error());
		$errorCode->AddError('item_sql',$sql);
		return $errorCode;
    }
	
	return true;

}


function CreateCode()
{
	$code = date("Y").'-'.date('m').date('d').'-';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZZZ';
	for ($i = 0; $i < 8; $i++) 
	{
		$code = $code.$characters[rand(0, strlen($characters)-2)];
		if($i == 3)
		{
			$code = $code.'-';
		}
	}
	return $code;	
}

 function is_logged_in()
{
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		return true;
	}
}

 function WriteHistory($action, $data, $target)
{
	$errorCode = new errorCode();
	$history = "INSERT INTO history (id_user, action,target,data , date) VALUES('".$_SESSION['id']."', '".$action."', '".$target."', '".$data."', NOW())";
	$query_history = mysql_query($history) or die('error at try to access data' . mysql_error());
	if (!$query_history) {
	$errorCode->AddError('history',mysql_error());
	$errorCode->AddError('item_sql',$history);
		return $errorCode;
	}
}

function CreateItem($item_name, $item_title, $item_description, $item_country,
 $item_city, $item_address, $item_category, $item_type , $imgs_path)
{
	
	/*Load  Logged User ID and generate the item code*/
	$item_user = $_SESSION['id'];

	
	$valide_code = false;
	while(!$valide_code)
	{
		$item_code = CreateCode();
		$sql = "select * from item where code='".$item_code."'";
		$query = mysql_query($sql);
		if(!$row = mysql_fetch_assoc($query))
		{
			$valide_code = true;
		}
		
	}
	/*Safe the item in the DB*/
	$sql =  'INSERT INTO item (';
	$sql =  $sql. 'code' ;
	$sql =  $sql. ',name' ;
	$sql =  $sql. ',description' ;
	$sql =  $sql. ',title' ;
	$sql =  $sql. ',status' ;
	$sql =  $sql. ',findlost_address' ;
	$sql =  $sql. ',type' ;
	$sql =  $sql. ',id_category' ;
	$sql =  $sql. ',id_user' ;
	$sql =  $sql. ',country' ;
	$sql =  $sql. ',city' ;
	$sql =  $sql. ',create_date' ;
	$sql =  $sql. ',last_mod_date' ;
	$sql =  $sql. ')' ;
	$sql =  $sql. ' VALUES (' ;
	$sql =  $sql. ' "'.$item_code.'"' ;
	$sql =  $sql. ',"'.$item_name.'"' ;
	$sql =  $sql. ',"'.$item_description.'"' ;
	$sql =  $sql. ',"'.$item_title.'"' ;
	$sql =  $sql. ',"Active"' ;
	$sql =  $sql. ',"'.$item_address.'"' ;
	$sql =  $sql. ',"'.$item_type.'"' ;
	$sql =  $sql. ','.$item_category.'' ;
	$sql =  $sql. ','.$item_user.'' ;
	$sql =  $sql. ',"'.$item_country.'"' ;
	$sql =  $sql. ',"'.$item_city.'"' ;
	$sql =  $sql. ',NOW()' ;
	$sql =  $sql. ',NOW()' ;
	$sql =  $sql. ')' ;

	$query = mysql_query($sql);
	
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('item',mysql_error());
		$errorCode->AddError('item_sql',$sql);
		
		return $errorCode;
    }
		
	/*Safe the Photos in the DB*/
	$item = new item($item_code);
	for ($i = 0; $i < count($imgs_path); $i++) 
	{
		$sql =  'INSERT INTO item_photo (';
		$sql =  $sql. 'path' ;
		$sql =  $sql. ',id_item' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. ''.$imgs_path[$i].'' ;
		$sql =  $sql. ','.$item->item_id.'' ;
		$sql =  $sql. ')' ;
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());;
	}
	$item = new item($item_code);
	return $item;	
		
}

function ModifyItem($item_code,$item_name, $item_title, $item_description, $item_country,
 $item_city, $item_address, $item_category, $item_type , $imgs_path)
 {
	/*Guardamos el item en la base de datos*/
	$item = new item($item_code);
	$item_id = $item->item_id;
		
	$sql = "UPDATE item SET";
	$sql = $sql." name = '".$item_name."'";
	$sql = $sql.", description = '".$item_description."'";
	$sql = $sql.", title = '".$item_title."'";
	$sql = $sql.", findlost_address = '".$item_address."'";
	$sql = $sql.", type = '".$item_type."'";
	$sql = $sql.", id_category = ".$item_category."";
	$sql = $sql.", country = '".$item_country."'";
	$sql = $sql.", city = '".$item_city."'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$item_id; 
		
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('item',mysql_error());
		$errorCode->AddError('item_sql',$sql);
		return $errorCode;
    }	
	
	$sql = "DELETE FROM item_photo WHERE id_item =".$item_id; 
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
		
	for ($i = 0; $i < count($imgs_path); $i++) 
	{
		$sql =  'INSERT INTO item_photo (';
		$sql =  $sql. 'path' ;
		$sql =  $sql. ',id_item' ;
		$sql =  $sql. ')' ;
		$sql =  $sql. ' VALUES (' ;
		$sql =  $sql. ''.$imgs_path[$i].'' ;
		$sql =  $sql. ','.$item_id.'' ;
		$sql =  $sql. ')' ;
		$query = mysql_query($sql)or die('error at try to access data' . mysql_error());;
	}
	
	$item = new item($item_code);
	return $item;
 }
 
 function DeleteItem($item_code)
 {
	$item = new item($item_code);
	$item_id = $item->item_id;
	$sql = "UPDATE item SET";
	$sql = $sql." status = 'Erased'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$item_id; 
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('item',mysql_error());
		$errorCode->AddError('item_sql',$sql);
		return $errorCode;
    }	
	return true;
}

function CreateOrder($order_code, $order_item_id, $order_message,
 $order_title, $order_address, $order_user_reviced_id)
{
	/*Load  Logged User ID and generate the item code*/
	$order_user_send_id = $_SESSION['id'];
	$valide_code = false;
	while(!$valide_code)
	{
		$order_code = CreateCode();
		$sql = "select * from order where code='".$order_code."'";
		$query = mysql_query($sql);
		if(!$row = mysql_fetch_assoc($query))
		{
			$valide_code = true;
		}
	}
	
	$order_code = CreateCode();
	/*Safe the item in the DB*/
	$sql =  'INSERT INTO order (';
	$sql =  $sql. 'code' ;
	$sql =  $sql. ',id_item' ;
	$sql =  $sql. ',status' ;
	$sql =  $sql. ',message' ;
	$sql =  $sql. ',title' ;
	$sql =  $sql. ',address' ;
	$sql =  $sql. ',id_user_send' ;
	$sql =  $sql. ',id_user_recived' ;
	$sql =  $sql. ',create_date' ;
	$sql =  $sql. ',last_mod_date' ;
	$sql =  $sql. ')' ;
	$sql =  $sql. ' VALUES (' ;
	$sql =  $sql. ' "'.$order_code.'"' ;
	$sql =  $sql. ','.$order_item_id.'' ;
	$sql =  $sql. ',"On Hold"' ;
	$sql =  $sql. ',"'.$order_message.'"' ;
	$sql =  $sql. ',"'.$order_title.'"' ;
	$sql =  $sql. ',"'.$order_address.'"' ;
	$sql =  $sql. ','.$order_user_send_id.'' ;
	$sql =  $sql. ','.$order_user_reviced_id.'' ;
	$sql =  $sql. ', NOW()' ;
	$sql =  $sql. ', NOW()' ;
	$sql =  $sql. ')' ;

	$query = mysql_query($sql);
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('orden',mysql_error());
		$errorCode->AddError('orden_sql',$sql);
		return $errorCode;
    }	
	/*Safe the Photos in the DB*/
	$orden = new order($order_code);
	return $orden;		
}


function ModifyOrder($order_code,$order_name,$order_message,$order_title,$order_address,$order_user_reviced_id)
{
	/*Guardamos el item en la base de datos*/
	$order = new order($order_code);
	$order_id = $order->order_id;
		
	$sql = "UPDATE order SET";
	$sql = $sql." status = '".$order_name."'";
	$sql = $sql.", message = '".$order_message."'";
	$sql = $sql.", title = '".$order_title."'";
	$sql = $sql.", address = '".$order_address."'";
	$sql = $sql.", id_user_recived = '".$order_user_reviced_id."'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$order_id; 
		
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('order',mysql_error());
		$errorCode->AddError('order_sql',$sql);
		return $errorCode;
    }	
	
	$order = new order($order_code);
	return $order;
}

function DeleteOrder($order_code)
 {
	$order = new order($order_code);
	$order_id = $order->order_id;
	$sql = "UPDATE order SET";
	$sql = $sql." status = 'Erased'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$order_id; 
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('order',mysql_error());
		$errorCode->AddError('order_sql',$sql);
		return $errorCode;
    }	
	return true;
}








function CreateShipment($shipment_code, $shipment_item_id, $shipment_message,
 $shipment_title, $shipment_address, $shipment_user_reviced_id)
{
	/*Load  Logged User ID and generate the item code*/
	$shipment_user_send_id = $_SESSION['id'];
	$valide_code = false;
	while(!$valide_code)
	{
		$shipment_code = CreateCode();
		$sql = "select * from submit where code='".$shipment_code."'";
		$query = mysql_query($sql);
		if(!$row = mysql_fetch_assoc($query))
		{
			$valide_code = true;
		}
	}
	
	$order_code = CreateCode();
	/*Safe the item in the DB*/
	$sql =  'INSERT INTO submit (';
	$sql =  $sql. 'code' ;
	$sql =  $sql. ',id_item' ;
	$sql =  $sql. ',status' ;
	$sql =  $sql. ',message' ;
	$sql =  $sql. ',title' ;
	$sql =  $sql. ',address' ;
	$sql =  $sql. ',id_user_send' ;
	$sql =  $sql. ',id_user_recived' ;
	$sql =  $sql. ',create_date' ;
	$sql =  $sql. ',last_mod_date' ;
	$sql =  $sql. ')' ;
	$sql =  $sql. ' VALUES (' ;
	$sql =  $sql. ' "'.$shipment_code.'"' ;
	$sql =  $sql. ','.$shipment_item_id.'' ;
	$sql =  $sql. ',"On Hold"' ;
	$sql =  $sql. ',"'.$shipment_message.'"' ;
	$sql =  $sql. ',"'.$shipment_title.'"' ;
	$sql =  $sql. ',"'.$shipment_address.'"' ;
	$sql =  $sql. ','.$shipment_user_send_id.'' ;
	$sql =  $sql. ','.$shipment_user_reviced_id.'' ;
	$sql =  $sql. ', NOW()' ;
	$sql =  $sql. ', NOW()' ;
	$sql =  $sql. ')' ;

	$query = mysql_query($sql);
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('shipment',mysql_error());
		$errorCode->AddError('shipment_sql',$sql);
		return $errorCode;
    }	
	/*Safe the Photos in the DB*/
	$orden = new order($order_code);
	return $orden;		
}


function ModifyShipment($shipment_code,$shipment_name,$shipment_message,$shipment_title,$shipment_address,$shipment_user_reviced_id)
{
	/*Guardamos el item en la base de datos*/
	$shipment = new shipment($shipment_code);
	$shipment_id = $shipment->shipment_id;
		
	$sql = "UPDATE submit SET";
	$sql = $sql." status = '".$shipment_name."'";
	$sql = $sql.", message = '".$shipment_message."'";
	$sql = $sql.", title = '".$shipment_title."'";
	$sql = $sql.", address = '".$shipment_address."'";
	$sql = $sql.", id_user_recived = '".$shipment_user_reviced_id."'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$shipment_id; 
		
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('shipment',mysql_error());
		$errorCode->AddError('shipment_sql',$sql);
		return $errorCode;
    }	
	
	$shipment = new shipment($shipment_code);
	return $shipment;
}

function DeleteShipment($shipment_code)
 {
	$shipment = new shipment($shipment_code);
	$shipment_id = $shipment->shipment_id;
	$sql = "UPDATE submit SET";
	$sql = $sql." status = 'Erased'";
	$sql = $sql.", last_mod_date = NOW()";
	$sql = $sql." WHERE id=".$shipment_id; 
	$query = mysql_query($sql)or die('error at try to access data' . mysql_error());
	$errorCode = new errorCodes();
	if (!$query) {
		$errorCode->AddError('shipment',mysql_error());
		$errorCode->AddError('shipment_sql',$sql);
		return $errorCode;
    }	
	return true;
}


?>