<?php require_once "db.php";
class user extends db
{
	public function insert($username, $fullname, $rank, $password)
	{
		$query = "INSERT INTO director (username,fullname,rank,password) VALUES(?,?,?,?) ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$username, $fullname, $rank, $password])) {
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
		}
		return $rank;	
	}
	public function load($page)
	{
		$query = "SELECT * FROM director LIMIT 20 OFFSET $page";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>username</th><th>password</th><th>ตำแหน่ง</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$director_id = $row['director_id'];
			$username = $row['username'];
			$password = $row['password'];
			$rank = $row['rank'];
			//แปลงตำแหน่ง
			$rank = $this->translate_rank($rank);
			$fullname = $row['fullname'];
			$out .= "<tr><td>$resultcount</td><td>$username</td><td><p style='display:none' id='hide_pass_$resultcount'>$password</p><i onclick='hidepass($resultcount)' class='bx bx-hide'></i></td><td>$rank</td><td>$fullname</td>";
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
		return $out;
	}
	// update data
	public function update($username, $fullname, $password, $director_id)
	{
		$query = "UPDATE director SET username = ?,fullname = ?,password = ? where director_id = ? ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$username, $fullname, $password, $director_id])) {
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
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>username</th><th>password</th><th>ตำแหน่ง</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$director_id = $row['director_id'];
			$username = $row['username'];
			$fullname = $row['fullname'];
			$rank = $row['rank'];
			$password = $row['password'];
			$out .= "<tr><td>$count</td><td>$username</td><td><p style='display:none' id='hide_pass_$count'>$password</p><i onclick='hidepass($count)' class='bx bx-hide'></i></td><td>$rank</td><td>$fullname</td>";
			$out .= "<td><a href='edit.php?director_id=$director_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span director_id='$director_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
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
