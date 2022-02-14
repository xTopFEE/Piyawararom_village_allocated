<?php require_once "class.php";

if(isset($_GET['payment_id'])){
	$user = new user;
	$data = $user->get_row($_GET['payment_id']);
	echo json_encode($data);
}