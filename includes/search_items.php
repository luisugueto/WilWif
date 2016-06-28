<?php 
 if(isset($_POST['s']))
 {
	$page = '';
	$records = '';
	$total = '';
	$searchvalue = $_POST['s'];
	$sql = 	'SELECT code FROM item';
	$sql = 	$sql.' where (name like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or description like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or title like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or findlost_address like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or id_category in (select id from item_category where slug like "%'.$searchvalue.'%"))';
	if(isset($_POST['filter']))
	{
		$sql = 	$sql.' and (id_category in (select id from item_category where slug = "'.$_POST['filter'].'"))';
	}
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	$categoty_list = array();
	$item_list = array();
	while($row = mysql_fetch_assoc($query))
	{
		$item = new item($row["code"]);
		array_push($item_list, $item);	
		//if (!in_array($item->item_category_slug, $categoty_list)) {
			//array_push($categoty_list, $item->item_category_slug);
		//}
			
	}
	$sql = 	'SELECT id_category FROM item';
	$sql = 	$sql.' where name like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or description like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or title like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or findlost_address like "%'.$searchvalue.'%"';
	$sql = "select slug from item_category where id in (".$sql.")";
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	while($row = mysql_fetch_assoc($query))
	{
			array_push($categoty_list, $row['slug']);
			
	}
	$arrayJson = array( 'rows' => $item_list,'page' => $page,'records' => $records,'total' => $total ,'category_list' => $categoty_list,'errorMsj' => '','success' => true);
	die (json_encode($arrayJson));
 }
	$arrayJson = array( 'errorMsj' => 'Access Denied','success' => false);
	die (json_encode($arrayJson));
?>