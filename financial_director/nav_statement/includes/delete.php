<?php require_once "class.php";
if(empty($_POST['accounting_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->delete($_POST['accounting_id']);	
}
