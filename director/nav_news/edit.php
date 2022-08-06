<?php
//session_start();
//if (!isset($_SESSION['username'])) {
//$_SESSION['msg'] = "กรุณาล็อกอินก่อน";
//header('location: ../login.php');
//}

?>
<?php
//1. เชื่อมต่อ database: 


require_once 'connection.php';
$db = new mysqli('127.0.0.1', 'root', '', 'project');
if (isset($_GET['id'])) {

	//get image id
	$img_id = $_GET['id'];

	//check if image is present
	$img = $db->query("SELECT * FROM uploadfile WHERE id = $img_id");

	//no of rows
	$no_of_rows = $img->num_rows;

	if (!$no_of_rows) {
		die("Image not found!");
	}
} //end of get check
else {
	die("Image not found!");
}


//check if form submitted
if (isset($_POST["submit"])) {

	$error = false;
	$status = "";

	//check if file is not empty
	if (!empty($_FILES["image"]["name"])) {

		//file info 
		$file_name = basename($_FILES["image"]["name"]);
		$file_type = pathinfo($file_name, PATHINFO_EXTENSION);

		//make an array of allowed file extension
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG');


		//check if upload file is an image
		if (in_array($file_type, $allowed_file_types)) {

			$tmp_image = $_FILES['image']['tmp_name'];
			$img_content = addslashes(file_get_contents($tmp_image));
			


			
		} else {
			$error = true;
			$status = 'Only support jpg, jpeg, png, gif,JPG format';
		}
	}if (!empty($_FILES["image1"]["name"])) {

		//file info 
		$file_name1 = basename($_FILES["image1"]["name"]);
		$file_type1 = pathinfo($file_name1, PATHINFO_EXTENSION);

		//make an array of allowed file extension
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG');


		//check if upload file is an image
		if (in_array($file_type1, $allowed_file_types)) {

			$tmp_image1 = $_FILES['image1']['tmp_name'];
			$img_content1 = addslashes(file_get_contents($tmp_image1));
				
		} else {
			$error = true;
			$status = 'Only support jpg, jpeg, png, gif,JPG format';
		}
	}if (!empty($_FILES["image2"]["name"])) {

		//file info 
		$file_name2 = basename($_FILES["image2"]["name"]);
		$file_type2 = pathinfo($file_name2, PATHINFO_EXTENSION);

		//make an array of allowed file extension
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG');


		//check if upload file is an image
		if (in_array($file_type2, $allowed_file_types)) {

			$tmp_image2 = $_FILES['image3']['tmp_name'];
			$img_content2 = addslashes(file_get_contents($tmp_image2));
				
		} else {
			$error = true;
			$status = 'Only support jpg, jpeg, png, gif,JPG format';
		}
	}if (!empty($_FILES["image3"]["name"])) {

		//file info 
		$file_name3 = basename($_FILES["image3"]["name"]);
		$file_type3 = pathinfo($file_name3, PATHINFO_EXTENSION);

		//make an array of allowed file extension
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG');


		//check if upload file is an image
		if (in_array($file_type3, $allowed_file_types)) {

			$tmp_image3 = $_FILES['image3']['tmp_name'];
			$img_content3 = addslashes(file_get_contents($tmp_image3));
				
		} else {
			$error = true;
			$status = 'Only support jpg, jpeg, png, gif,JPG format';
		}
	}if (!empty($_FILES["image4"]["name"])) {

		//file info 
		$file_name4 = basename($_FILES["image4"]["name"]);
		$file_type4 = pathinfo($file_name4, PATHINFO_EXTENSION);

		//make an array of allowed file extension
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'JPG');


		//check if upload file is an image
		if (in_array($file_type4, $allowed_file_types)) {

			$tmp_image4 = $_FILES['image4']['tmp_name'];
			$img_content4 = addslashes(file_get_contents($tmp_image4));
				
		} else {
			$error = true;
			$status = 'Only support jpg, jpeg, png, gif,JPG format';
		}
	}
	
	$headlines1 = $_POST['headlines1'];
	$news1 = $_POST['news1'];

	$query = $db->query("UPDATE uploadfile SET image = '$img_content',image1 = '$img_content1',
	image2 = '$img_content2',image3 = '$img_content3',image4 = '$img_content4',
	 headlines1 = '$headlines1', news1 = '$news1' WHERE id = $img_id");

			//check if successfully inserted
			// if ($query) {
			// 	$status = "Image has been successfully updated.";
			// } else {
			// 	$error = true;
			// 	$status = "Something went wrong when updating image!!!";
			// }
			echo "<script type=text/javascript>";
			//echo "alert(\"บันทึกเรียบร้อย\");";
			echo "window.location=\"news.php\"";
			echo "</script>";



} //end of post check

$img = $db->query("SELECT * FROM uploadfile WHERE id = $img_id");



$row = $img->fetch_row();

//image title
$img_head = $row[0];
$img_news = $row[1];


// $query = "SELECT * FROM uploadfile" or die("Error:" . mysqli_error($con));
// //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
// $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="style.css">
	<!-- Boxicons CDN -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Comfirm box -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
				<a href="user.php">
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
				<a href="./nav_admin/admin.php">
					<i class='bx bx-code-block'></i>
					<span class="links_name">แอดมิน</span>
				</a>
				<span class="tooltip">แอดมิน</span>
			</li>
			<li>
				<a href="#">
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
									<div class="job">กรรมการ</div>
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
		<div class="text">ข่าวสารประชาสัมพันธ์</div>

		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		</head>

		<?php if (!isset($_GET['id'])) {
			header("Location: news.php?id=id");
		} ?>
		<!doctype html>
		<html>

		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<title>ข่าวสารประชาสัมพันธ์</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		</head>

		<body">
			<br>


			<div class="container">
				<div class="container shadow-lg bg-light py-3" id='editBox' style="border-radius: 12px;">
					<h2 class='text-center'>แก้ไขข้อมูลข่าวสารประชาสัมพันธ์</h2><br>
					<div id='msgEdit'></div>


					<?php
					if (isset($error)) {

						if (!$error) {
							echo '
							<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
		                        <strong>Well done!</strong> ' . $status . '
		                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                            <span aria-hidden="true">×</span>
		                        </button>
		                    </div>';
						} else {
							echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
				                    <strong>Oh snap!</strong> ' . $status . '
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                        <span aria-hidden="true">×</span>
				                    </button>
				                </div>';
						}
					}


					?>


					<form class="col-8" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="headlines1">หัวข้อข่าวสาร</label>
							<input type="text" class="form-control" id="headlines1" name="headlines1" placeholder="หัวข้อข่าวสาร" value="<?php echo $img_head; ?>" required>
						</div>
						<div class="form-group">
							<label for="news1">รายละเอียดข่าว</label>
							<input type="text" class="form-control" id="news1" name="news1" placeholder="รายละเอียดข่าวสาร" value="<?php echo $img_news; ?>">

						</div>

						<div class="form-group">
							<label for="image">รูปหัวข่าว
							<input type="file" class="form-control-file" id="image" name="image" placeholder="select image" ></label><br><br>
							<label for="image">รูปที่เกี่ยวข้อง
							<input type="file" class="form-control-file" id="image1" name="image1" placeholder="select image" ><br>
							<input type="file" class="form-control-file" id="image2" name="image2" placeholder="select image" ><br>
							<input type="file" class="form-control-file" id="image1" name="image3" placeholder="select image" ><br>
							<input type="file" class="form-control-file" id="image2" name="image4" placeholder="select image" >
							</label>
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-success">แก้ไขข้อมูล</button>
							<a href="news.php" class="btn btn-info">ยกเลิก</a>
						</div>

					</form>



					<br>
				</div>
			</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/edit.js"></script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>