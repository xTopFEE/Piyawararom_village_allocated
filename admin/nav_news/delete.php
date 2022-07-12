<?php 
require_once "class.php";
if(isset($_POST['id'])){
	$id = new id;
	$data = $id->delete($_POST['id']);
	echo json_encode($data);
}
