<?php require_once "db.php";
class user extends db
{
	public function insert($date, $income, $expense, $balance, $other)
	{
		// $now = new Date();
		// $now = date ('Y-m-d H:i:s');
		// $date = $now;
		$query = "INSERT INTO accounting (date,income,expense,balance,other) VALUES(?,?,?,?,?) ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$date, $income, $expense, $balance, $other])) {
			echo "เพิ่มข้อมูลเรียบร้อย!";
		}
	}
	public function get_row($accounting_id)
	{
		$query = "SELECT * FROM accounting WHERE accounting_id = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$accounting_id]);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return $row;
		}
	}
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
		$split_date = explode("-", $date);
		$newformat = "";

		// แก้ ปี ค.ศ. เป็น พ.ศ.
		$old_year = $split_date[0];

		// return "สวัสดี";
		if (count($split_date) > 1) {
			//(int)$split_date[0] คือ เดือน
			switch ((int)$split_date[1]) {
				case 1:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ม.ค. $split_date[0]";
					break;
				case 2:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ก.พ. $split_date[0]";
					break;
				case 3:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] มี.ค. $split_date[0]";
					break;
				case 4:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] เม.ย. $split_date[0]";
					break;
				case 5:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] พ.ค. $split_date[0]";
					break;
				case 6:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] มิ.ย. $split_date[0]";
					break;
				case 7:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ก.ค. $split_date[0]";
					break;
				case 8:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ส.ค. $split_date[0]";
					break;
				case 9:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ก.ย. $split_date[0]";
					break;
				case 10:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ต.ค. $split_date[0]";
					break;
				case 11:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] พ.ย. $split_date[0]";
					break;
				case 12:
					$split_date[0] = $this->change_year_format($old_year);
					echo "<script> console.log('$split_date[2]: ' + $split_date[2]) </script>";
					$newformat = "$split_date[2] ธ.ค. $split_date[0]";
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
	public function load($page, $SelectedYear, $SelectedMonth)
	{
		// $query = "SELECT * FROM accounting LIMIT 20 OFFSET $page";
		if ($SelectedYear != 0 || $SelectedMonth != 0) {
			if ($SelectedYear != 0) {
				$SelectedYear = $SelectedYear - 543;
			}
			echo "<script>console.log('year on load = $SelectedYear');</script>";
			if ($SelectedYear == 0 && $SelectedMonth != 0) {
				$query = "SELECT * FROM accounting WHERE MONTH(`date`) = $SelectedMonth ORDER BY `date` DESC LIMIT 20 OFFSET 0";
			} else if ($SelectedMonth == 0 && $SelectedYear != 0) {

				$query = "SELECT * FROM accounting WHERE YEAR(`date`) = $SelectedYear ORDER BY `date` DESC LIMIT 20 OFFSET 0";
			} else {
				$query = "SELECT * FROM accounting WHERE YEAR(`date`) = $SelectedYear AND MONTH(`date`) = $SelectedMonth ORDER BY 'date' DESC LIMIT 20 OFFSET 0";
			}
		} else {
			$query = "SELECT * FROM accounting ORDER BY 'date' DESC LIMIT 20 OFFSET 0";
		}
		echo "<script>console.log('query = $query');</script>";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>วันที่</th><th>รายรับ (บาท)</th><th>รายจ่าย (บาท)</th><th>ยอดคงเหลือ (บาท)</th><th colspan='2'>หมายเหตุ</th></tr>";
		$count = 1;
		$balanceArray = array();
		$dateArray = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$resultcount = $page + $count;
			// $accounting_id = $row['accounting_id'];
			$date = $row['date'];
			//แปลง format date
			$date = $this->change_date_format($date);
			// เดือนออกแล้ว แต่ค่อยคิดเงื่อนไข if เพื่อแปลงเดือนเป็นเดือนไทย
			$income = $row['income'];

			if ($income == 0) {
				$income = "0";
			}

			$expense = $row['expense'];

			if ($expense == 0) {
				$expense = "0";
			}

			$balance = $row['balance'];
			$other = $row['other'];
			array_push($balanceArray, $balance);
			array_push($dateArray, $date);

			$income = $this->change_money_format($income);
			$expense = $this->change_money_format($expense);
			$balance = $this->change_money_format($balance);

			$out .= "<tr><td>$resultcount</td><td>$date</td><td style='text-align: right !important'>$income</td><td style='text-align: right !important'>$expense</td><td style='text-align: right !important'>$balance</td><td>$other</td>";
			// $out .= "<td><a href='edit.php?accounting_id=$accounting_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			// $out .= "<td><span accounting_id='$accounting_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		}
		echo ' <script>
		var balanceArray = [];
		var dateArray = [];
    var options = {
        chart: {
            height: 350,
            type: "line",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#FF1654", "#247BA0"],
        series: [{
                name: "Series A",
                data: [6, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
            },

        ],
        stroke: {
            width: [4, 4]
        },
        plotOptions: {
            bar: {
                columnWidth: "20%"
            }
        },
        xaxis: {
            categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016]
        },
        yaxis: [{
            axisTicks: {
                show: true
            },
            axisBorder: {
                show: true,
                color: "#FF1654"
            },
            labels: {
                style: {
                    colors: "#FF1654"
                }
            },
            title: {
                text: "ยอดคงเหลือ",
                style: {
                    color: "#FF1654"
                }
            }
        }],
        tooltip: {
            shared: false,
            intersect: true,
            x: {
                show: false
            }
        },
        legend: {
            horizontalAlign: "left",
            offsetX: 40
        }
    };


    
    ';
		$balanceArray = array_reverse($balanceArray, true);
		foreach ($balanceArray as $value) {
			echo " balanceArray.push('$value'); ";
		};
		$dateArray = array_reverse($dateArray, true);
		foreach ($dateArray as $value) {
			echo " dateArray.push('$value'); ";
		};
		echo ' options.series[0].data = balanceArray ;';
		echo ' options.xaxis.categories = dateArray ;';
		echo 'var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render(); 
	</script>
	';
		return $out;
	}
	// update data
	public function update($income, $expense, $balance, $other, $accounting_id)
	{
		// INSERT INTO accounting (date,income,expense,balance,other) VALUES(?,?,?,?,?)
		$query = "UPDATE accounting SET income = ?,expense = ?,balance = ?,other = ? where accounting_id = ? ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$income, $expense, $balance, $other, $accounting_id])) {
			echo "ข้อมูลถูกแก้ไขแล้ว! <a href='statement.php'>ดูข้อมูล</a>";
		}
	}
	//user search results
	public function search($text)
	{
		$text = strtolower($text);
		$query = "SELECT * FROM accounting WHERE username LIKE ? OR password LIKE ? OR fullname LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text, $text, $text, $text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>username</th><th>password</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$accounting_id = $row['accounting_id'];
			$username = $row['username'];
			$fullname = $row['fullname'];
			$password = $row['password'];
			$out .= "<tr><td>$count</td><td>$username</td><td><p style='display:none' id='hide_pass_$count'>$password</p><i onclick='hidepass($count)' class='bx bx-hide'></i></td><td>$fullname</td>";
			$out .= "<td><a href='edit.php?accounting_id=$accounting_id' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			$out .= "<td><span accounting_id='$accounting_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";
			$count++;
		}
		$out .= "</table>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
		}
		return $out;
	}

	public function delete($accounting_id)
	{
		$query = "DELETE FROM accounting WHERE accounting_id = ?";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$accounting_id])) {
			echo "ลบเรียบร้อยแล้ว";
		}
	}
	//end of class
}
