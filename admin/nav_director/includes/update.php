<?php require_once "class.php";
if(empty($_POST['director_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->update($_POST['username'],$_POST['fullname'],$_POST['password'],$_POST['director_id']);
}
