<?php require('../includes/config.php');
require('../classes/db.php');

$db = new DB();

//logout
$db->logout(); 

//logged in return to index page
header('Location: index.php');
exit;
?>