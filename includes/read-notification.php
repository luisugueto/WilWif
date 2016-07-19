<?php


if (isset($_POST['notification_id']) && $_SESSION['id']) {
	
	$notification_id = $_POST['notification_id'];
	$query = "UPDATE notification SET status = 'Read' WHERE id = ".$notification_id." and id_user=".$_SESSION['id'];
	$sql = mysql_query($query);
	if($sql)
	{
		$arrayJson = array('success' => true, 'notification_id' => $notification_id);
		echo json_encode($arrayJson);
		die();
	}
	
}


?>