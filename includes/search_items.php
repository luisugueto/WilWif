<?php 
 if(isset($_POST['s']))
 {
	$page = '';
	$records = '';
	$total = '';
	$searchvalue = $_POST['s'];
	$sql = 	'SELECT code FROM item';
	$sql = 	$sql.' where name like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or description like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or title like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or findlost_address like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or id_category in (select id from item_category where slug like "%'.$searchvalue.'%")';
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	
	$item_list = array();
	while($row = mysql_fetch_assoc($query))
	{
		$item = new item($row["code"]);
		array_push($item_list, $item);			
	}
	$arrayJson = array( 'rows' => $item_list,'page' => $page,'records' => $records,'total' => $total ,'errorMsj' => '','success' => true);
	die (json_encode($arrayJson));
 }
	$arrayJson = array( 'errorMsj' => 'Access Denied','success' => false);
	die (json_encode($arrayJson));
?>