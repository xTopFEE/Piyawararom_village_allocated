<?php require_once "class.php";
if(empty($_POST['accounting_id'])){
	echo "Not found";
	die();
} else {
	$user = new user;
	$user->update($_POST['income'],$_POST['expense'],$_POST['balance'],$_POST['other'],$_POST['accounting_id']);
	// $income, $expense, $balance, $other, $accounting_id
}
