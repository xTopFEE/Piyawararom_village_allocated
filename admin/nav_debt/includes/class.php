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
	public function load($page, $enter_year)
	{
		if(!empty($enter_year))
		echo "<script> console.log('enter year in load :' + $enter_year) </script>";
		if (!empty($enter_year)) {
			// $query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE year='$enter_year' GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) LIMIT 20 OFFSET $page";
			$query = "WITH added_row_number AS ( SELECT *,SUM(amount) as 'sum' , ROW_NUMBER() OVER(PARTITION BY `house_id`) AS 'row_number' FROM payment WHERE month IN('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม') and year='$enter_year' GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) ) SELECT * FROM added_row_number LIMIT 20 OFFSET $page";
		} else {
			$query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) DESC LIMIT 20 OFFSET $page";
		}

		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th colspan='2'>ลำดับ</th><th>ปี</th><th>บ้านเลขที่</th><th>จ่ายไปแล้ว (บาท)</th><th>ยังไม่ได้ชำระเงินปี$enter_year (บาท)</th><th>รายละเอียด</th></tr>";
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
			$out .= "<tr><td colspan='2'>$seq</td><td>$year</td><td style='text-align: left !important'>$house_id</td><td style='text-align: right !important'>$sum / 3600</td><td style='text-align: right !important'>$amountsum</td>";
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
		$enter_year = $_SESSION['enter_year'];
		// $query = "SELECT *,SUM(amount) as 'sum' FROM payment WHERE year='$enter_year' AND house_id LIKE ? GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int)";
		$query = "WITH added_row_number AS ( SELECT *,SUM(amount) as 'sum' , ROW_NUMBER() OVER(PARTITION BY `house_id`) AS 'row_number' FROM payment WHERE month IN('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม') and year='$enter_year' AND house_id LIKE ? GROUP BY house_id ORDER BY cast(SUBSTRING_INDEX(house_id, '/', -1)as int) ) SELECT * FROM added_row_number";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th colspan='2'>ลำดับ</th><th>ปี</th><th>บ้านเลขที่</th><th>จ่ายไปแล้ว (บาท)</th><th>ยังไม่ได้ชำระเงินปี$enter_year (บาท)</th><th>รายละเอียด</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $count;
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
			$out .= "<tr><td colspan='2'>$seq</td><td>$year</td><td>$house_id</td><td>$sum / 3600</td><td>$amountsum</td>";
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
