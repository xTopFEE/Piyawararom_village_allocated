<?php require_once "class.php";
if(empty($_POST['df_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$img = null;
		if(isset($_FILES['upload'])){
			$img = $_FILES['upload'];
		}
	$user->update($_POST['df_id'],$_POST['name'],$_POST['other'],$img);
}
