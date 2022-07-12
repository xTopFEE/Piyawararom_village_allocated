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
		$query = "SELECT * FROM fileupload WHERE fileupload = ? ";
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
		$query = "SELECT * FROM form WHERE user_id = '$current_user_id' LIMIT 20 OFFSET $page";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>รายละเอียด</th><th>วันที่</th><th>สถานะ</th><th colspan='2'>การดำเนินการ</th><th>การตอบกลับ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$id = $row['form_id'];
			// $fileupload = $row['fileupload'];
			$form_id = $row['form_id'];
			$date = $row['date'];
			$file = $row['file'];
			$reply = $row['reply'];
			$other = $row['other'];
			$status	 = $row['status'];
			$out .= "<tr><td>$resultcount</td><td>$other</td><td>$date</td><td>$status</td>";
			$out .= "<td><a href='edit.php?id=$id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span id='$id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$out .= "<td>$reply</td>";
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
	public function update($fileupload){
		$query = "UPDATE fileupload SET fileupload = ?";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$fileupload])){
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='news.php'>ดูข้อมูล</a>";
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
	
	public function delete($fileupload){
		$query = "DELETE FROM fileupload WHERE fileupload = ?";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$fileupload])){
			echo "ลบเรียบร้อยแล้ว";
		}
	}
//end of class
}