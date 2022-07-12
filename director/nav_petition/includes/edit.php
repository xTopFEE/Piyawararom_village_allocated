<?php 
require_once "class.php";
if(isset($_POST['complaint_status']) && isset($_POST['admin_callback']) && isset($_POST['complaint_id'])){
	$id = new id;
	
	$data = $id->update($_POST['complaint_status'],$_POST['admin_callback'],$_POST['complaint_id']);
	echo json_encode($data);
}
