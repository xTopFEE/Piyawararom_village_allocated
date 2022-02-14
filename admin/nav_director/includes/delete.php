<?php require_once "class.php";
if(empty($_POST['director_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->delete($_POST['director_id']);	
}
