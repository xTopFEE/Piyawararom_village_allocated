<?php require_once "db.php";
class user extends db
{
	public function insert($username, $fullname, $rank, $password, $img)
	{
		$filename = 'no-img.png';
		

		if($img != null){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($img["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			$check = getimagesize($img["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
			}



			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
			}

			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			if (move_uploaded_file($img["tmp_name"], $target_file)) {
				$filename =  htmlspecialchars( basename( $img["name"]));
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			}
		}

		$query = "INSERT INTO director (username,fullname,rank,password,file) VALUES(?,?,?,?,?) ";
		
			$stmt = $this->connect()->prepare($query);
			if ($stmt->execute([$username, $fullname, $rank, $password,$filename])) {
				echo "เพิ่มข้อมูลเรียบร้อย!";
			}
		
	}
	public function get_row($director_id)
	{
		$query = "SELECT * FROM director WHERE director_id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$director_id]);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return $row;
		}
	}
	public function translate_rank($rank) {
		switch ($rank) {
			case 'president': 
				$rank = "ประธานกรรมการ";
				break;
			case "vice_president_financial": 
				$rank = "รองประธานกรรมการ ฝ่ายการเงิน";
				break;
			case "vice_president_civil": 
				$rank = "รองประธานกรรมการ ฝ่ายโยธา";
				break;
			case "financial_director": 
				$rank = "กรรมการและเหรัญญิก";
				break;
			case "director_public_relations": 
				$rank = "กรรมการฝ่ายประชาสัมพันธ์";
				break;
			case "director": 
				$rank = "กรรมการและเลขานุการ";
				break;
			case "other":
				$rank = "กรรมการตำแหน่งอื่นๆ";
				break;
		}
		return $rank;	
	}
	public function load($page)
	{
		$query = "SELECT * FROM director LIMIT 20 OFFSET $page";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>รูปภาพ</th><th>username</th><th>password</th><th>ตำแหน่ง</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$director_id = $row['director_id'];
			$username = $row['username'];
			$password = $row['password'];
			$rank = $row['rank'];
			$img = $row['file'] == null? 'no-img.png':$row['file'];
			//แปลงตำแหน่ง
			$rank = $this->translate_rank($rank);
			$fullname = $row['fullname'];
			$out .= "<tr><td>$resultcount</td><td><a href='./includes/uploads/$img' target='_blank'><img src=\"./includes/uploads/$img\" width='40'></a></td><td>$username</td><td><p style='display:none' id='hide_pass_$resultcount'>$password</p><i onclick='hidepass($resultcount)' class='bx bx-hide'></i></td><td>$rank</td><td style='text-align: left !important'>$fullname</td>";
			$out .= "<td><a href='edit.php?director_id=$director_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span director_id='$director_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		return $out;
	}
	// update data
	public function update($username, $fullname, $password, $rank, $director_id, $img)
	{
		$filename = null;
		

		if($img != null){
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($img["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			$check = getimagesize($img["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
			}



			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
			}

			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			if (move_uploaded_file($img["tmp_name"], $target_file)) {
				$filename =  htmlspecialchars( basename( $img["name"]));
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			}
		}
		$sql = '';
		$arr = [$username, $fullname, $password, $rank, $director_id];
		if($filename != null){
			$sql = ',file=? ';
			$arr = [$username, $fullname, $password, $rank, $filename, $director_id];
		}
		
		$query = "UPDATE director SET username = ?,fullname = ?,password = ?,rank = ?$sql where director_id = ? ";
		$stmt = $this->connect()->prepare($query);

		if ($stmt->execute($arr)) {
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='director.php'>ดูข้อมูล</a>";
		}
	}
	//user search results
	public function search($text)
	{
		$text = strtolower($text);
		$query = "SELECT * FROM director WHERE username LIKE ? OR password LIKE ? OR rank LIKE ? OR fullname LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text, $text, $text, $text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>รูปภาพ</th><th>username</th><th>password</th><th>ตำแหน่ง</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $count;
			$director_id = $row['director_id'];
			$username = $row['username'];
			$password = $row['password'];
			$rank = $row['rank'];
			$img = $row['file'] == null? 'no-img.png':$row['file'];
			//แปลงตำแหน่ง
			$rank = $this->translate_rank($rank);
			$fullname = $row['fullname'];
			$out .= "<tr><td>$resultcount</td><td><a href='./includes/uploads/$img' target='_blank'><img src=\"./includes/uploads/$img\" width='40'></a></td><td>$username</td><td><p style='display:none' id='hide_pass_$resultcount'>$password</p><i onclick='hidepass($resultcount)' class='bx bx-hide'></i></td><td>$rank</td><td style='text-align: left !important'>$fullname</td>";
			$out .= "<td><a href='edit.php?director_id=$director_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span director_id='$director_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		return $out;
	}

	public function delete($director_id)
	{
		$query = "DELETE FROM director WHERE director_id = ?";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$director_id])) {
			echo "ลบเรียบร้อยแล้ว";
		}
	}
	//end of class
}
