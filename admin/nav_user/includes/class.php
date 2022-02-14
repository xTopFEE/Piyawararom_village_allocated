<?php require_once "db.php";
class user extends db {
	public function insert($username,$fullname,$password){
		$query = "INSERT INTO user(username,fullname,password) VALUES(?,?,?) ";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$username,$fullname,$password])){
			echo "เพิ่มข้อมูลเรียบร้อย!";
		}
	}
	public function get_row($user_id){
		$query = "SELECT * FROM user WHERE user_id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$user_id]);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			return $row;		
		}
	}
	public function load($page){	
		
		
		$query = "SELECT * FROM user LIMIT 20 OFFSET $page";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
			$out = "";
			$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>username</th><th>password</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
			$count = 1;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$resultcount = $page + $count;
				$user_id = $row['user_id'];
				$username = $row['username'];
				$password = $row['password'];
				$fullname = $row['fullname'];
				$out .="<tr><td>$resultcount</td><td>$username</td><td><p style='display:none' id='hide_pass_$resultcount'>$password</p><i onclick='hidepass($resultcount)' class='bx bx-hide'></i></td><td>$fullname</td>";
				$out .="<td><a href='edit.php?user_id=$user_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";    
				//$out .="<td><span user_id='$user_id' class='del btn btn-sm btn-danger' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
				$count ++;
			} 
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		

		if($stmt->rowCount() == 0 ){
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		return $out;
		return $out;
	}
	// update data
	public function update($username,$fullname,$password,$user_id){
		$query = "UPDATE user SET username = ?,fullname = ?,password = ? where user_id = ? ";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$username,$fullname,$password,$user_id])){
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='user.php'>ดูข้อมูล</a>";
		}
	}
	//user search results
	public function search($text){
		$text = strtolower($text); 
		$query = "SELECT * FROM user WHERE username LIKE ? OR fullname LIKE ? OR password LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text,$text,$text]);
			$out = "";
			$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>username</th><th>password</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
			$count = 1;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$user_id = $row['user_id'];
				$username = $row['username'];
				$fullname = $row['fullname'];
				$password = $row['password'];
				$out .="<tr><td>$count</td><td>$username</td><td><p style='display:none' id='hide_pass_$count'>$password</p><i onclick='hidepass($count)' class='bx bx-hide'></i></td><td>$fullname</td>";
				$out .="<td><a href='edit.php?user_id=$user_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";    
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
	
	public function delete($user_id){
		$query = "DELETE FROM user WHERE user_id = ?";
		$stmt = $this->connect()->prepare($query);
		if($stmt->execute([$user_id])){
			echo "ลบเรียบร้อยแล้ว";
		}
	}
//end of class
}