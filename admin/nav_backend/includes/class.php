<?php require_once "db.php";
class user extends db
{
	/*public function insert($username, $fullname, $password)
	{
		$query = "INSERT INTO admin (username,fullname,password) VALUES(?,?,?) ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$username, $fullname, $password])) {
			echo "เพิ่มข้อมูลเรียบร้อย!";
		}
	}*/
	public function get_row($payment_id)
	{
		$query = "SELECT * FROM payment WHERE payment_id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$payment_id]);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

	public function load($page, $enter_year)
	{
		$this->get_id();

		if(!empty($enter_year))
		echo "<script> console.log('enter year in load :' + $enter_year) </script>";
		if (!empty($enter_year)) {
			$query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE year='$enter_year' GROUP BY house_id HAVING SUM(amount) < 3600 ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) LIMIT 20 OFFSET $page";
		} else {
			$query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE GROUP BY house_id HAVING SUM(amount) < 3600 ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) DESC LIMIT 20 OFFSET $page";
		}

		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th colspan='2'>ลำดับ</th><th>ปี</th><th>บ้านเลขที่</th><th>จ่ายไปแล้ว (บาท)</th><th>ค้างชำระ (บาท)</th><th>รายละเอียด</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$payment_id = $row['payment_id'];
			$seq = $row['seq'];
			$book_name = $row['book_name'];
			$year = $row['year'];
			$month = $row['month'];
			$house_id = $row['house_id'];
			$book_number = $row['book_number'];
			$number = $row['number'];
			$date_paid = $row['date_paid'];
			$amount = $row['amount'];
			$other = $row['other'];
			$sum = $row['sum'];
			$amountsum = 3600 - $sum;
			$out .= "<tr><td colspan='2'>$seq</td><td>$year</td><td>$house_id</td><td>$sum / 3600 บาท</td><td>$amountsum บาท</td>";
			$strhref = "";
			if(strpos($house_id, '/') !== false) {
				$array_houseid = explode('/', $house_id);
				$first_houseid = $array_houseid[0];
				$array_length = count($array_houseid);
				$last_houseid = $array_houseid[$array_length-1];
				$strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&last_houseid=$last_houseid&enter_year=$enter_year";
			} else {
				$first_houseid = $house_id;
				$last_houseid = "false";
				$strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&enter_year=$enter_year";
			}
			$out .= "<td><a href='$strhref' class='edit btn btn-sm btn-info' title='ดูรายละเอียด'><i class='bx bx-detail'></i></a></td>";
			// $out .= "<td>$other</td>";
			//$out .= "<td><span payment_id='$payment_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		$_SESSION['Total_house'] = $count;
		return $out;
	}
	// update data
	public function update($username, $fullname, $password, $payment_id)
	{
		$query = "UPDATE admin SET username = ?,fullname = ?,password = ? where payment_id = ? ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$username, $fullname, $password, $payment_id])) {
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='admin.php'>ดูข้อมูล</a>";
		}
	}
	//user search results
	public function search($text)
	{
		$text = strtolower($text);
		$query = "SELECT * FROM payment WHERE house_id LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th colspan='3'>ชื่อเล่ม</th><th>ปี</th><th>ค่าส่วนกลางประจำเดือน</th><th>บ้านเลขที่</th><th>เล่มที่</th><th>เลขที่</th><th>วันที่จ่าย</th><th>จำนวน</th><th colspan='2'>หมายเหตุ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$payment_id = $row['payment_id'];
			$seq = $row['seq'];
			$book_name = $row['book_name'];
			$year = $row['year'];
			$month = $row['month'];
			$house_id = $row['house_id'];
			$book_number = $row['book_number'];
			$number = $row['number'];
			$date_paid = $row['date_paid'];
			$amount = $row['amount'];
			$other = $row['other'];
			$out .= "<tr><td colspan='2'>$seq</td><td colspan='2'>$book_name</td><td>$year</td><td>$month</td><td>$house_id</td><td>$book_number</td><td>$number</td><td>$date_paid</td><td>$amount</td><td>$other</td>";
			//$out .= "<td><a href='edit.php?payment_id=$payment_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			//$out .= "<td><span payment_id='$payment_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		$_SESSION['Total_house'] = $count;
		return $out;
	}

	public function delete($payment_id)
	{
		$query = "DELETE FROM payment WHERE payment_id = ?";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$payment_id])) {
			echo "ลบเรียบร้อยแล้ว";
		}
	}
	//end of class
}
