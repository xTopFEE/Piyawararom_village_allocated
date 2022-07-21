<?php require_once "class.php";
if (!empty($_POST)) {
	$user = new user;
	$user->insert($_POST['date'], $_POST['income'], $_POST['expense'], $_POST['balance'], $_POST['other']);
	echo "<script>
		Swal.fire(
			'เพิ่มข้อมูลกรรมการเรียบร้อย',
			'',
			'success'
		)
		</script>";
}
