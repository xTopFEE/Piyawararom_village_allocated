<?php require_once "class.php";
if(empty($_POST['id'])){
	echo "Not found";
	die();
} else {
	$news = new $news1;
	$news1->update($_POST['headlines1'],$_POST['news1'],$_POST['']);
}
