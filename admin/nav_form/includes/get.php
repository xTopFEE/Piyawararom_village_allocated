<?php require_once "class.php";

if(isset($_GET['admin_id'])){
	$user = new user;
	$data = $user->get_row($_GET['admin_id']);
	echo json_encode($data);
}