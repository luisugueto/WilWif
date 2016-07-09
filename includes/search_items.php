<?php 
 if(isset($_POST['s']))
 {
	$searchvalue = $_POST['s'];
	if(isset($_POST['filter']))
	{
		$filter_value =  $_POST['filter'];
	}else{
		$filter_value = '';
	}
	
	/* first we make all make the query for the result*/
	
	
	$sql = 	' where (name like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or description like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or title like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or findlost_address like "%'.$searchvalue.'%"';
	$sql = 	$sql.' or id_category in (select id from item_category where slug like "%'.$searchvalue.'%"))';
	if(isset($_POST['type']))
	{
		$sql = 	$sql.' and  type="'.$_POST['type'].'" ';
	}
	if(!isset($_POST['special']))
	{
		$sql = 	$sql.' and  status !="Erased" ';
	}
	if(isset($_POST['filter']))
	{
		$sql = 	$sql.' and (id_category in (select id from item_category where slug = "'.$_POST['filter'].'"))';
	}
	
	$query = mysql_query('SELECT Count(*) as total FROM item'.$sql) or die('error at try to access data' . mysql_error());
	
		
	$pages = 1;// 1
	$records = 0;
	$result_num = 5; // number of result for page
	$page = 1; // defaults
	$searchfrom = 0;
	if(isset($_POST['page']))
	{
		$page = $_POST['page'];
		$searchfrom = ($_POST['page']-1)*$result_num;
	}
	$total = 0;
	if($row = mysql_fetch_assoc($query))
	{
		$total = $row['total'];
	}
	$pages = ceil($total/$result_num);
	
	/*after get all data for the table we make the result for the data */
	$sql = 	'SELECT code FROM item'.$sql;
	
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	$categoty_list = array();
	while($row = mysql_fetch_assoc($query))
	{
		$item = new item($row["code"]);
		if (!in_array($item->item_category_slug, $categoty_list)) {
			array_push($categoty_list, $item->item_category_slug);
		}
	}
	
	$sql = 	$sql.' LIMIT '.$searchfrom.', '.$result_num;
	
	$query = mysql_query($sql) or die('error at try to access data' . mysql_error());
	$item_list = array();
	while($row = mysql_fetch_assoc($query))
	{
		$records++;
		$item = new item($row["code"]);
		array_push($item_list, $item);
		
	}
	
	$arrayJson = array('search_value' => $searchvalue,'filter_value' => $filter_value,'rows' => $item_list,'page' => $page,'pages' => $pages,'records' => $records,'total' => $total ,'category_list' => $categoty_list,'errorMsj' => '','success' => true);
	die (json_encode($arrayJson));
 }
	$arrayJson = array('errorMsj' => 'Access Denied','success' => false);
	die (json_encode($arrayJson));
?>