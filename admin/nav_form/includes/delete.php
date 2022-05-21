<?php require_once "class.php";
if(empty($_POST['admin_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->delete($_POST['admin_id']);	
}
