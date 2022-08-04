<?php require_once "class.php";
if(empty($_POST['df_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->update($_POST['df_id'],$_POST['other']);
}
