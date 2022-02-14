<?php require_once "class.php";
if(!empty($_POST)){
	$user = new user;
	$user->insert($_POST['username'],$_POST['fullname'],$_POST['password']);
}
