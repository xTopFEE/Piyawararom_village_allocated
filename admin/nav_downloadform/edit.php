<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "กรุณาล็อกอินก่อน";
	header('location: ../login.php');
}
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
				<a href="../nav_user/user.php">
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
				<a href="#">
					<i class='bx bx-broadcast'></i>
					<span class="links_name">ข่าวสารประชาสัมพันธ์</span>
				</a>
				<span class="tooltip">ข่าวสารประชาสัมพันธ์</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-chat'></i>
					<span class="links_name">การร้องเรียนทั่วไป</span>
				</a>
				<span class="tooltip">การร้องเรียนทั่วไป</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-spreadsheet'></i>
					<span class="links_name">การชำระเงิน</span>
				</a>
				<span class="tooltip">การชำระเงิน</span>
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
									<div class="job">Admin</div>
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
		<div class="text">กรรมการ</div>

		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		</head>

		<?php if (!isset($_GET['director_id'])) {
			header("Location: director.php?msg=invalid");
		} ?>
		<!doctype html>
		<html>

		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>สมาชิกในหมู่บ้าน</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		</head>

		<body>
			<br>
			<div class="container">
				<div class="container shadow-lg bg-light py-3" id='editBox' style="border-radius: 12px;">
					<h2 class='text-center'>แก้ไขข้อมูลกรรมการ</h2><br>
					<div id='msgEdit'></div>
					<form action="" id='editForm' method="post">
						<div class="form-group">
							<label>
								<h4>username</h4>
							</label>
							<input disabled="disabled" type="text" id="upd_username" name="upd_username" placeholder="username" class='form-control sm-3 mx-auto' required>
						</div><br>
						<div class="form-group">
							<label>
								<h4>รหัสผ่าน</h4>
							</label>
							<input type="text" id="upd_password" name="upd_password" placeholder="รหัสผ่าน" class='form-control sm-3 mx-auto' required>
						</div><br>
						<div class="form-group">
							<label>
								<h4>ยืนยันรหัสผ่าน</h4>
							</label>
							<input type="text" id="upd_password_2" name="upd_password_2" placeholder="ยืนยันรหัสผ่าน" class='form-control sm-3 mx-auto' required>
						</div><br>
						<div class="form-group">
							<label>
								<h4>ชื่อ-นามสกุล</h4>
							</label>
							<input type="text" id="upd_fullname" name="upd_fullname" placeholder="ชื่อ-นามสกุล" class='form-control sm-5 mx-auto' required>
						</div><br>
						<div class="form-group">
							<label>
								<h4>ตำแหน่ง</h4>
							</label><br>
							<select name="upd_rank" id="upd_rank">
								<option value="president">ประธานกรรมการ</option>
								<option value="vice_president_financial">รองประธานกรรมการ ฝ่ายการเงิน</option>
								<option value="vice_president_civil">รองประธานกรรมการ ฝ่ายโยธา</option>
								<option value="financial_director">กรรมการและเหรัญญิก</option>
								<option value="director_public_relations">กรรมการฝ่ายประชาสัมพันธ์</option>
								<option value="director">กรรมการและเลขานุการ</option>
								<option value="other">กรรมการตำแหน่งอื่นๆ</option>
							</select>
						</div><br>
						<div class="form-group">
							<label>
								<h4>รูปภาพ</h4>
							</label>
							<input type="file" id="upload" name="upload">
						</div><br>
						<center>
							<input type="submit" value="แก้ไข" class='btn update btn-success'>
							<a href="./director.php" class='btn btn-danger'>ยกเลิก</a>
						</center>
					</form>
					<br>
				</div>
			</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/edit.js"></script>
</section>


<script>
	$(document).ready(function() {
		$('#import_excel_form').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: "import.php",
				method: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function() {
					$('#import').attr('disabled', 'disabled');
					$('#import').val('Importing...');
				},
				success: function(data) {
					$('#message').html(data);
					$('#import_excel_form')[0].reset();
					$('#import').attr('disabled', false);
					$('#import').val('Import');
				}
			})
		});
	});
</script>


<script>
	let sidebar = document.querySelector(".sidebar");
	let closeBtn = document.querySelector("#btn");

	closeBtn.addEventListener("click", () => {
		sidebar.classList.toggle("open");
		menuBtnChange(); //calling the function
	});

	// following are the code to change sidebar button
	function menuBtnChange() {
		if (sidebar.classList.contains("open")) {
			closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
		} else {
			closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
		}
	}
</script>
</body>

</html>