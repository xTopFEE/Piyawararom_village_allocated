<?php require_once "class.php";
if(empty($_POST['form_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->update($_POST['form_id'],$_POST['other']);
}
