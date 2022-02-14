<?php require_once "class.php";

if(isset($_GET['user_id'])){
	$user = new user;
	$data = $user->get_row($_GET['user_id']);
	echo json_encode($data);
}