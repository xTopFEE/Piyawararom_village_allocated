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

	public function get_id()
	{
		$user = $_SESSION['username'];
		echo "<script> console.log('$user');</script>";
		$type = $_SESSION['usertype'];
		echo "<script> console.log('$type');</script>";

		if ($type == 'user') {
			$table = "user";
			$setrow = "user_id";
		} else if ($type == 'admin') {
			$table = "adminn";
			$setrow = "admin_id";
		} else if ($type == 'director') {
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

	public function get_month_number($month)
	{
		$number = 0;
		switch ($month) {
			case "มกราคม":
				$number = 1;
				break;
			case "กุมภาพันธ์":
				$number = 2;
				break;
			case "มีนาคม":
				$number = 3;
				break;
			case "เมษายน":
				$number = 4;
				break;
			case "พฤษภาคม":
				$number = 5;
				break;
			case "มิถุนายน":
				$number = 6;
				break;
			case "กรกฎาคม":
				$number = 7;
				break;
			case "สิงหาคม":
				$number = 8;
				break;
			case "กันยายน":
				$number = 9;
				break;
			case "ตุลาคม":
				$number = 10;
				break;
			case "พฤศจิกายน":
				$number = 11;
				break;
			case "ธันวาคม":
				$number = 12;
				break;
		}
		return $number;
	}

	public function change_money_format($money)
	{
		return number_format($money, 0, '.', ',');
	}

	public function load($page, $enter_year)
	{
		$this->get_id();

		// echo "<script> console.log('thismonth :' + $thismonth) </script>";	
		$query = "WITH added_row_number AS ( SELECT *,SUM(amount) as 'sum' , ROW_NUMBER() OVER(PARTITION BY `house_id`) AS 'row_number' FROM payment WHERE month IN('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม') GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) ) SELECT * FROM added_row_number LIMIT 20 OFFSET $page";

		// while ($min_year <= $this_year) {

		// 	$query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE year='$min_year' GROUP BY house_id HAVING SUM(amount) < 3600 ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) LIMIT 20 OFFSET $page";

		// 	echo "<script> console.log('Min year :' + $min_year) </script>";
		// 	$min_year++;
		// }


		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th colspan='2'>บ้านเลขที่</th><th>ปีที่เริ่มชำระค่าส่วนกลาง</th><th>จำนวนเดือนที่ชำระทั้งหมด</th><th>จำนวนเงินที่จ่ายไปแล้ว (บาท)</th><th>จำนวนที่ต้องจ่ายทั้งหมด (บาท)</th><th>ยอดค้างชำระทั้งหมด (บาท)</th></tr>";
		$count = 1;

		$thismonth = date("m");
		$this_year = date("Y"); // 2565
		$this_year = $this_year + 543; // change year to thai
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			$payment_id = $row['payment_id'];
			$seq = $row['seq'];
			$book_name = $row['book_name'];
			$year = $row['year'];
			$month = $row['month'];
			// ส่วนการคำนวณระยะเวลาเดือนตั้งแต่อยู่จนถึงปัจจุบัน
			$RemainYear = ($this_year - $year) * 12;
			$datamonth = $this->get_month_number($month);
			$totalmonth = $RemainYear - ($datamonth - $thismonth);
			//
			$house_id = $row['house_id'];
			$book_number = $row['book_number'];
			$number = $row['number'];
			$date_paid = $row['date_paid'];
			$amount = $row['amount'];
			$other = $row['other'];
			$sum = $row['sum'];
			$amountsum = $totalmonth * 300;
			$remainsum = $amountsum - $sum;
			//ใส่ลูกน้ำ
			$sum = $this->change_money_format($sum);
			$amountsum = $this->change_money_format($amountsum);
			$remainsum = $this->change_money_format($remainsum);
			$out .= "<tr><td colspan='2' style='text-align: left !important'>$house_id</td><td>$year</td><td>$totalmonth</td><td style='text-align: right !important'>$sum</td><td style='text-align: right !important'>$amountsum</td><td style='text-align: right !important'>$remainsum</td>";
			$strhref = "";
			if (strpos($house_id, '/') !== false) {
				$array_houseid = explode('/', $house_id);
				$first_houseid = $array_houseid[0];
				$array_length = count($array_houseid);
				$last_houseid = $array_houseid[$array_length - 1];
				$strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&last_houseid=$last_houseid&enter_year=$enter_year";
			} else {
				$first_houseid = $house_id;
				$last_houseid = "false";
				$strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&enter_year=$enter_year";
			}
			// $out .= "<td><a href='$strhref' class='edit btn btn-sm btn-info' title='ดูรายละเอียด'><i class='bx bx-detail'></i></a></td>";
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
		$query = "WITH added_row_number AS ( SELECT *,SUM(amount) as 'sum' , ROW_NUMBER() OVER(PARTITION BY `house_id`) AS 'row_number' FROM payment WHERE month IN('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม') GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) ) SELECT * FROM added_row_number WHERE house_id LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th colspan='2'>บ้านเลขที่</th><th>ปีที่เริ่มชำระค่าส่วนกลาง</th><th>จำนวนเดือนที่ชำระทั้งหมด</th><th>จำนวนเงินที่จ่ายไปแล้ว (บาท)</th><th>จำนวนที่ต้องจ่ายทั้งหมด (บาท)</th><th>ยอดค้างชำระทั้งหมด (บาท)</th></tr>";
		$count = 1;

		$thismonth = date("m");
		$this_year = date("Y"); // 2565
		$this_year = $this_year + 543; // change year to thai
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			// $resultcount = $page + $count;
			$payment_id = $row['payment_id'];
			$seq = $row['seq'];
			$book_name = $row['book_name'];
			$year = $row['year'];
			$month = $row['month'];
			// ส่วนการคำนวณระยะเวลาเดือนตั้งแต่อยู่จนถึงปัจจุบัน
			$RemainYear = ($this_year - $year) * 12;
			$datamonth = $this->get_month_number($month);
			$totalmonth = $RemainYear - ($datamonth - $thismonth);
			//
			$house_id = $row['house_id'];
			$book_number = $row['book_number'];
			$number = $row['number'];
			$date_paid = $row['date_paid'];
			$amount = $row['amount'];
			$other = $row['other'];
			$sum = $row['sum'];
			$amountsum = $totalmonth * 300;
			$remainsum = $amountsum - $sum;
			$out .= "<tr><td colspan='2'>$house_id</td><td>$year</td><td>$totalmonth</td><td>$sum</td><td>$amountsum</td><td>$remainsum</td>";
			$strhref = "";
			if (strpos($house_id, '/') !== false) {
				// $array_houseid = explode('/', $house_id);
				// $first_houseid = $array_houseid[0];
				// $array_length = count($array_houseid);
				// $last_houseid = $array_houseid[$array_length - 1];
				// $strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&last_houseid=$last_houseid&enter_year=$enter_year";
			} else {
				// $first_houseid = $house_id;
				// $last_houseid = "false";
				// $strhref = "../nav_debt_detail/debt_detail.php?first_houseid=$first_houseid&enter_year=$enter_year";
			}
			// $out .= "<td><a href='$strhref' class='edit btn btn-sm btn-info' title='ดูรายละเอียด'><i class='bx bx-detail'></i></a></td>";
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
