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
	// แก้ ปี ค.ศ. เป็น พ.ศ.
	public function change_year_format($old_year)
	{
		$old_year = $old_year + 543;
		$old_year = $old_year / 100;

		echo "<script> console.log('old_year: ' + $old_year) </script>";
		$split_year = explode('.', $old_year);
		echo "<script> console.log('split_year :' + $split_year[1]) </script>";
		return $split_year[1];
	}
	public function change_date_format($date)
	{
		// 1(เดือน)/2(วัน)/2565(ปี)
		$split_date = explode(" ", $date);
		$newformat = "";

		$old_year = $split_date[2] + 2000;

		// return "สวัสดี";
		if (count($split_date) > 1) {
			//(int)$split_date[0] คือ เดือน
			switch ($split_date[1]) {
				case 'Jan':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ม.ค. $split_date[2]";
					break;
				case 'Feb':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ก.พ. $split_date[2]";
					break;
				case 'Mar':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] มี.ค. $split_date[2]";
					break;
				case 'Apr':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] เม.ย. $split_date[2]";
					break;
				case 'May':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] พ.ค. $split_date[2]";
					break;
				case 'Jun':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] มิ.ย. $split_date[2]";
					break;
				case 'Jul':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ก.ค. $split_date[2]";
					break;
				case 'Aug':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ส.ค. $split_date[2]";
					break;
				case 'Sep':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ก.ย. $split_date[2]";
					break;
				case 'Oct':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ต.ค. $split_date[2]";
					break;
				case 'Nov':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] พ.ย. $split_date[2]";
					break;
				case 'Dec':
					$split_date[2] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[0] ธ.ค. $split_date[2]";
					break;
				default:
					$newformat = $date;
			}
		} else {
			$newformat = $date;
		}
		return $newformat;
	}
	public function change_money_format($money)
	{
		return number_format($money, 0, '.', ',');
	}
	public function load($page, $enter_year,$first_houseid,$last_houseid)
	{
		if(!empty($enter_year))
		echo "<script> console.log('enter year in load :' + $enter_year) </script>";
		if (!empty($enter_year)) {
			if(!empty($first_houseid)&&!empty($last_houseid)){
				echo "<script> console.log('inif in class') </script>";
				echo "<script> console.log('$first_houseid/$last_houseid') </script>";
				$query = "SELECT * FROM payment WHERE year = '$enter_year' AND house_id = '$first_houseid/$last_houseid' ORDER BY seq";
			}else{
				$query = "SELECT * FROM payment WHERE year='$enter_year' AND house_id='$first_houseid' ORDER BY seq LIMIT 20 OFFSET $page";
			}
			echo "<script> console.log('query') </script>";
		} else {
			$query = "SELECT * FROM payment ORDER BY seq LIMIT 20 OFFSET $page";
		}

		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th colspan='2'>ปี</th><th>ค่าส่วนกลางประจำเดือน</th><th>บ้านเลขที่</th><th>วันที่จ่าย</th><th>จำนวน (บาท)</th><th colspan='2'>หมายเหตุ</th></tr>";
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
			//แปลง format date
			$date_paid = $this->change_date_format($date_paid);
			$amount = $row['amount'];
			$amount = $this->change_money_format($amount);
			$other = $row['other'];
			$out .= "<tr><td colspan='2'>$seq</td><td>$year</td><td>$month</td><td style='text-align: left !important'>$house_id</td><td>$date_paid</td><td style='text-align: right !important'>$amount</td><td>$other</td>";
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
