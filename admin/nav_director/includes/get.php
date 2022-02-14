<?php require_once "class.php";

if(isset($_GET['director_id'])){
	$user = new user;
	$data = $user->get_row($_GET['director_id']);
	echo json_encode($data);
}