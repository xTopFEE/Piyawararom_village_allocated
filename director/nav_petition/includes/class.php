<?php require_once "db.php";
class id extends db
{
	public function insert($fileupload)
	{
		$query = "INSERT INTO user(fileupload,) VALUES(?) ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$fileupload])) {
			echo "เพิ่มข้อมูลเรียบร้อย!";
		}
	}
	public function get_row($fileupload)
	{
		$query = "SELECT * FROM fileupload WHERE fileupload = ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$fileupload]);
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			return $row;
		}
	}
	public function load($page)
	{
		$query = "SELECT * FROM uploadfile LIMIT 20 OFFSET $page";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();

		$db = new mysqli('127.0.0.1', 'root', '', 'project');
		//get all images
		$images = $db->query("SELECT * FROM uploadfile ORDER BY dateup DESC");

		//no of rows
		$no_of_rows = $images->num_rows;

		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'>
		<tr class='bg-light'>
		<th>ลำดับ</th>
		<th>รูปภาพหัวข้อข่าว</th>
		
		<th>หัวข้อข่าวสาร</th>
		<th>รายละเอียดข่าวสาร</th>
		<th>วันที่</th>
		<th colspan='2'>การดำเนินการ</th>
		</tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if ($no_of_rows > 0) {

				$count = 1;
				while ($img = $images->fetch_object()) {
					$resultcount = $page + $count;
					$id = $img->id;
					$img_file = base64_encode($img->image);
					$img_file1 = base64_encode($img->image1);
					$img_file2 = base64_encode($img->image2);
					$img_file3 = base64_encode($img->image3);
					$img_file4 = base64_encode($img->image4);
					$date = date('m/d/y', strtotime($img->uploaded));
					$out .= "<tr>
					<td> $count </td>
					<td>
						<img width='200px' height='150px'  src='data:image/jpg;charset=utf8;base64,$img_file' />
					</td>
					
					<td> $img->headlines1</td>
					<td> $img->news1</td>
					<td>  $date</td> ";

							
					$out .="<td><p style='display:none' id='hide_pass_$resultcount'></p></td>";
					$out .= "<td><a href='edit.php?id=$img->id 'class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
					$out .= "<td><span id='$id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td></tr>";
					$count++;
				}
			}$out .= "</table>";
			
		}
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-info text-center col-sm-5 mx-auto'>ไม่มีข้อมูล!</p>";
		//$out .= "<a href='./user.php?page=40'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> <br>";
		
		}
		return $out;
		return $out;
	}
	// update data
	public function update($status, $admin_callback, $complaint_id)
	{
		$query = "UPDATE complaint SET complaint_status = ?,admin_callback = ? where complaint_id = ? ";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$status, $admin_callback, $complaint_id])) {
			echo "ข้อมูลถูกแก้ไขแล้ว!";
		}
	}
	//user search results
	public function search($text)
	{
		$text = strtolower($text);
		$query = "SELECT * FROM fileupload WHERE fileupload LIKE ? ";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute([$text]);
		$out = "";
		$out .= "<table style='font-size:14px;' class='table table-responsive table-hover'><tr class='bg-light'><th>ลำดับ</th><th>fileupload</th><th>headlines1</th><th>ชื่อ-นามสกุล</th><th colspan='2'>การดำเนินการ</th></tr>";
		$count = 1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$fileupload = $row['fileupload'];

			$out .= "<tr><td>$count</td><td>$fileupload</td><td><p style='display:none' id='hide_pass_$count'>";
			$out .= "<td><a href='edit.php?fileupload=$fileupload' class='edit btn btn-sm btn-success' title='edit'><i class='fa fa-fw fa-pencil'></i></a></td>";
			//$out .="<td><span user_id='$user_id' class='del btn btn-sm btn-danger' onclick='myFunction()' title='delete'><i class='fa fa-fw fa-trash'></i></span></td>";    
			$count++;
		}
		$out .= "</table>";
		if ($stmt->rowCount() == 0) {
			$out = "";
			$out .= "<p class='alert alert-danger text-center col-sm-3 mx-auto'>Not Found.</p>";
		}
		return $out;
	}

	public function delete($id)
	{
		$query = "DELETE FROM complaint WHERE complaint_id = ?";
		$stmt = $this->connect()->prepare($query);
		if ($stmt->execute([$id])) {
			echo "ลบเรียบร้อยแล้ว";
		}
	}
	//end of class


	public function search_petition($text)
	{
		$query = "SELECT * FROM complaint where username = '$text' OR  complaint_tltle like ('%$text%') ORDER BY Date_time DESC";
		$stmt = $this->connect()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
