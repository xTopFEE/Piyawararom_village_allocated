<?php require_once "class.php";

if(isset($_GET['accounting_id'])){
	$user = new user;
	$data = $user->get_row($_GET['accounting_id']);
	echo json_encode($data);
}