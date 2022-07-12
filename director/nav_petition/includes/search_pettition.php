<?php 
require_once "class.php";
if(isset($_POST['username'])){
	$id = new id;
	$data = $id->search_petition($_POST['username']);
	echo json_encode($data);
	
}
