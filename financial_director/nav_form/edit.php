<?php
//session_start();
//if (!isset($_SESSION['username'])) {
//$_SESSION['msg'] = "กรุณาล็อกอินก่อน";
//header('location: ../login.php');
//}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<!-- Boxicons CDN -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Comfirm box -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<div class="sidebar">
		<div class="logo-details">
			<i class='bx bx-home-alt icon'></i>
			<div class="logo_name">หมู่บ้านปิยวรารมย์</div>
			<i class='bx bx-menu' id="btn"></i>
		</div>
		<ul class="nav-list">
			<li>
				<a href="../Backend.php">
					<i class='bx bx-grid-alt'></i>
					<span class="links_name">Dashboard</span>
				</a>
				<span class="tooltip">Dashboard</span>
			</li>
			<li>
				<a href="../nav_user/user.php?clear_page=true">
					<i class='bx bx-user'></i>
					<span class="links_name">สมาชิกในหมู่บ้าน</span>
				</a>
				<span class="tooltip">สมาชิกในหมู่บ้าน</span>
			</li>
			<li>
				<a href="../nav_director/director.php">
					<i class='bx bx-group'></i>
					<span class="links_name">กรรมการ</span>
				</a>
				<span class="tooltip">กรรมการ</span>
			</li>
			<li>
				<a href="../nav_admin/admin.php">
					<i class='bx bx-code-block'></i>
					<span class="links_name">แอดมิน</span>
				</a>
				<span class="tooltip">แอดมิน</span>
			</li>
			<li>
				<a href="../nav_form/form.php">
					<i class='bx bx-file'></i>
					<span class="links_name">แบบฟอร์มเอกสาร</span>
				</a>
				<span class="tooltip">แบบฟอร์มเอกสาร</span>
			</li>
			<li>
				<a href="../nav_news/news.php">
					<i class='bx bx-broadcast'></i>
					<span class="links_name">ข่าวสารประชาสัมพันธ์</span>
				</a>
				<span class="tooltip">ข่าวสารประชาสัมพันธ์</span>
			</li>
			<li>
				<a href="../nav_petition/petition.php">
					<i class='bx bx-chat'></i>
					<span class="links_name">การร้องเรียนทั่วไป</span>
				</a>
				<span class="tooltip">การร้องเรียนทั่วไป</span>
			</li>
			<li>
				<a href="../nav_payment/payment.php">
					<i class='bx bx-spreadsheet'></i>
					<span class="links_name">การชำระเงิน</span>
				</a>
				<span class="tooltip">การชำระเงิน</span>
			</li>
			<li>
				<a href="../nav_debt/debt.php">
					<i class='bx bx-calendar'></i>
					<span class="links_name">ยอดค้างชำระ</span>
				</a>
				<span class="tooltip">ยอดค้างชำระ</span>
			</li>
			<li>
				<a href="../setting.php">
					<i class='bx bx-cog'></i>
					<span class="links_name">การตั้งค่า</span>
				</a>
				<span class="tooltip">การตั้งค่า</span>
			</li>
			<!-- Logged in user detail -->
			<?php if (isset($_SESSION['username'])) : ?>

				<li class="profile">
					<div class="profile_content">
						<h1 href="#">
							<div class="profile-details">
								<img src="./user.png" alt="profileImg">
								<div class="name_job">
									<div class="name"><?php echo $_SESSION['username'] ?></div>
									<!-- RODJANAPHADIT -->
									<div class="job">กรรมการการเงิน</div>
								</div>
							</div>
						</h1>
						<a href="../../logout.php">
							<i class='bx bx-log-out' id="log_out"></i>
						</a>
					</div>
				</li>

			<?php endif ?>
			<!-- END -->
		</ul>
	</div>
	<section class="home-section">
		<div class="text">แบบฟอร์ม</div>

		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		</head>

		<?php require_once "includes/db.php";
		if (!isset($_GET['id'])) {
			header("Location: news.php?id=id");
		}

		class user extends db
		{
			public function getFileNameByID($formid)
			{
				$query = "SELECT * FROM form WHERE form_id='$formid'";
				$stmt = $this->connect()->prepare($query);
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

					$id = $row['form_id'];
					// $fileupload = $row['fileupload'];
					$form_id = $row['form_id'];
					$date = $row['date'];
					$file = $row['file'];
					$reply = $row['reply'];
					$other = $row['other'];
					$status	 = $row['status'];
				}
				return $file;
			}

			public function getStatusByID($formid) {
				$query = "SELECT * FROM form WHERE form_id='$formid'";
				$stmt = $this->connect()->prepare($query);
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

					$id = $row['form_id'];
					// $fileupload = $row['fileupload'];
					$form_id = $row['form_id'];
					$date = $row['date'];
					$file = $row['file'];
					$reply = $row['reply'];
					$other = $row['other'];
					$status	 = $row['status'];
				}
				return $status;
			}
		}
		if (isset($_GET['id'])) {
			$user = new user;
			$file = $user->getFileNameByID($_GET['id']);
			$status = $user->getStatusByID($_GET['id']);

			echo "<script> document.getElementById('fullname').value='$status'; </script>";
			echo "<script>console.log('Hello');</script>";
			// echo "<script>console.log('file=$file');</script>";
		}
		?>
		<!doctype html>
		<html>

		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>แก้ไขข้อมูลแบบฟอร์ม</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		</head>

		<body">
			<br>
			<div class="container">
				<div class="container shadow-lg bg-light py-3" id='editBox' style="border-radius: 12px;">
					<h2 class='text-center'>แก้ไขข้อมูลแบบฟอร์ม</h2><br>



					<div id='msgEdit'></div>
					<form action="" id='editForm' method="post">
						<div class="form-group">
							<label>
								<h4>แก้ไขสถานะแบบฟอร์ม</h4>
							</label><br>
							<select name="upd_status" id="upd_status">
								<option value="1">รอการตรวจสอบ</option>
								<option value="2">ได้รับการอนุมัติ</option>
								<option value="3">ไม่ผ่านการอนุมัติ</option>
							</select>
						</div><br>
						<div class="form-group">
							<label>
								<h4>ตอบกลับ</h4>
							</label><br>
							<textarea type="text" id="upd_reply" name="upd_reply" placeholder="ข้อมูลการตอบกลับ" class="form-control col-sm-9 mx-auto"></textarea><br><br>
						</div><br><br>
						<center>
							<input type="submit" value="แก้ไข" class='btn update btn-success '>
							<a href="./form.php" class='btn btn-danger'>ยกเลิก</a>
						</center>
					</form><br><br>
					<?php echo '<embed src="../../user/nav_form/fileupload/' . $file . '" width="1000px" height="1500px" />'; ?>
					<br>
				</div>
			</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/edit.js"></script>

</body>

</html>