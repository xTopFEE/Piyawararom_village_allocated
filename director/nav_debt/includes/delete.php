<?php require_once "class.php";
if(empty($_POST['payment_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->delete($_POST['payment_id']);	
}
