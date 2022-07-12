<?php require_once "class.php";
if(empty($_POST['id'])){
	echo "Not found";
	die();
} else {
	$id = new id;
	$id->delete($_POST['id']);	
}
