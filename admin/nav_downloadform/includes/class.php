<?php require_once "db.php";

class user extends db {
	public function insert($fileupload){
		$query = "INSERT INTO user(fileupload,) VALUES(?) ";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$fileupload])){
			echo "เพิ่มข้อมูลเรียบร้อย!";
		}
	}
	public function get_row($fileupload){
		$query = "SELECT * FROM downloadform WHERE df_id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$fileupload]);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row;		
		}
	}
	public function get_id() {
		$user = $_SESSION['username'];
		echo "<script> console.log('$user');</script>";
		$type = $_SESSION['usertype'];
		echo "<script> console.log('$type');</script>";

		if ($type == 'user') {
			$table = "user";
			$setrow = "user_id";
		}
		else if ($type == 'admin') {
			$table = "adminn";
			$setrow = "admin_id";
		}
		else if ($type == 'director') {
			$table = "director";
			$setrow = "director_id";
		}

		$qy = "SELECT * FROM $table WHERE username='$user'";
		$stmt = $this->connect()->prepare($qy);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$_SESSION['userid'] = $row[$setrow];
		}
		$SESSION_userid = $_SESSION['userid'];
		echo "<script> console.log('$SESSION_userid' + '(id)');</script>";
	}
	public function load($page)
	{
		$this->get_id();
		$current_user_id = $_SESSION['userid'];
		$query = "SELECT * FROM downloadform";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>วันที่</th><th>ไฟล์แบบฟอร์ม</th><th>ชื่อแบบฟอร์ม</th><th>รายละเอียด</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$id = $row['df_id'];
			// $fileupload = $row['fileupload'];
			$df_id = $row['df_id'];
			$name = $row['name'];
			$file = $row['file'];
			$date = $row['date'];
			$other = $row['other'];
			$out .= "<tr><td>$resultcount</td><td>$date</td><td><button class='btn btn-secondary' onclick='download(\"$file\")'>ดาวโหลด</button></td><td style='text-align: left !important'>$name</td><td style='text-align: left !important'>$other</td>";
			$out .= "<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span id='$id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
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
	public function update($df_id, $name, $other, $img)
	{
		$filename = null;
		

		if($img != null){
			$target_dir = "../fileupload/";
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
		$arr = [$name, $other, $df_id];
		if($filename != null){
			$sql = ',file=? ';
			$arr = [$name, $other, $filename, $df_id];
		}
		$query = "UPDATE downloadform SET name = ?,other = ?$sql where df_id = ? ";
		$stmt = $this->connect()->prepare($query);
		
		if ($stmt->execute($arr)) {
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='director.php'>ดูข้อมูล</a>";
		}
	}
	//user search results
	public function search($text){
		$text = strtolower($text); 
		$query = "SELECT * FROM fileupload WHERE fileupload LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text]);
			$out = "";
			$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>fileupload</th><th>headlines1</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
			$count = 1;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$fileupload = $row['fileupload'];
				
				$out .="<tr><td>$count</td><td>$fileupload</td><td><p style='display:none' id='hide_pass_$count'>";
				$out .="<td><a href='edit.php?fileupload=$fileupload' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";    
				//$out .="<td><span user_id='$user_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";    
				$count++;
			}
		$out .= "</table>";
		if($stmt->rowCount() == 0 ){
			$out = "";
			$out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
		}
		return $out;
	}
	
	public function delete($df_id){
		$query = "DELETE FROM downloadform WHERE df_id = ?";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$df_id])){
			echo "ลบเรียบร้อยแล้ว";
		}
	}
//end of class
}