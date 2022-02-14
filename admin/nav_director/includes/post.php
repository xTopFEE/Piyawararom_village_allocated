<?php require_once "class.php";
if (!empty($_POST)) {

	$password_1 = $_POST['password'];
	$password_2 = $_POST['password_2'];

	if (empty($password_1)) {
		echo "<script>
		Swal.fire(
			'กรุณาใส่รหัสผ่าน',
			'ตรวจสอบไม่พบรหัสผ่าน',
			'warning'
		)
		</script>";
	}
	if ($password_1 != $password_2) {
		echo "<script>
		Swal.fire(
			'กรุณาใส่รหัสผ่านใหม่',
			'ใส่รหัสผ่านไม่ตรงกัน',
			'warning'
		)
		</script>";
	}
	if ($password_1 == $password_2) {
		$user = new user;
		$user->insert($_POST['username'], $_POST['fullname'], $_POST['rank'], $_POST['password']);
		echo "<script>
		Swal.fire(
			'เพิ่มข้อมูลกรรมการเรียบร้อย',
			'',
			'success'
		)
		</script>";
	}
}