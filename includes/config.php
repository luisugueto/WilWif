<?php
ob_start();
session_start();
date_default_timezone_set('America/Caracas');
//set timezone
//date_default_timezone_set('Europe/London');

//database credentials
// define('DBHOST','localhost');
// define('DBUSER','appadminzuaru');
// define('DBPASS','d)*a-0CDLH]2');
// define('DBNAME','ap_wilwif');

//application address
#define('DIR','http://domain.com/');
#define('SITEEMAIL','noreply@domain.com');
$db=mysql_connect("localhost","zuarunet_appadmi","d)*a-0CDLH]2");
mysql_select_db("zuarunet_app_wilwif",$db);
// try {

// 	//create PDO connection
// 	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch(PDOException $e) {
// 	//show error
//     echo '<p class="bg-danger">'.$e->getMessage().'</p>';
//     exit;
// }

//include the user class, pass in the database connection
include('../classes/user.php');
#include('classes/phpmailer/mail.php');
$user = new User($db);
?>
