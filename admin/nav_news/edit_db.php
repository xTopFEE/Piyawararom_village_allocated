       <!-- // มีphp
        // include('connection.php');

        // $id = $_POST['id'];
        // $headlines1 = $_POST['headlines1'];
        // $news1 =  $_POST['news1'];

        // // UPDATE
        // $sql = "update uploadfile set headlines1='$headlines1',news1='$news1' where id='$id'";
        // if ($con->query($sql)) {
        //     $_SESSION['suc'] = "บันทึกข้อมูลสำเร็จ";
        //     header("location:news.php");
        // } else {
        //     $_SESSION['error'] = "บันทึกข้อมูลสำเร็จไม่สำเร็จ " . $con->error;
        //     header("location:edit.php?id=$id");
        // } -->

    
      

<meta charset="UTF-8">

<?php
 //1. เชื่อมต่อ database: 
 include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี



 $id = $_POST['id'];
 $headlines1 = $_POST['headlines1'];
 $news1 =  $_POST['news1'];

 


 //รับค่าไฟล์จากฟอร์ม	
 $fileupload = (isset($_POST['fileupload']) ? $_POST['fileupload'] : '');
$p_img2 = $_POST['p_img2'];


 //ฟังก์ชั่นวันที่
 date_default_timezone_set('Asia/Bangkok');
 $date = date("Ymd");
 //ฟังก์ชั่นสุ่มตัวเลข
 $numrand = (mt_rand());
 //เพิ่มไฟล์
 $upload = $_FILES['fileupload'];  //
 if ($upload != '') {   //not select file
	//โฟลเดอร์ที่จะ upload file เข้าไป 
	$path = "fileupload/";

	//เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
	$type = strrchr($_FILES['fileupload']['name'], ".");

	//ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
	$newname = $date . $numrand . $type;
	$path_copy = $path . $newname;
	$path_link = "fileupload/" . $newname;

	//คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
	move_uploaded_file($_FILES['fileupload']['tmp_name'], $path_copy);
} else {
     $newname = $p_img2;
 }




 // เพิ่มไฟล์เข้าไปในตาราง uploadfile

 $sql = "UPDATE uploadfile SET				 
             headlines1='$headlines1',
             news1='$news1' ,
             fileupload ='$newname'

             where id='$id'";

 $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));

 mysqli_close($con);
 // javascript แสดงการ upload file



 if ($result) {
     echo "<script type='text/javascript'>";
     //	echo "alert('อัพโหลดไฟล์สำเร็จ');";
     echo "window.location = 'news.php'; ";
     echo "</script>";
 } else {
     echo "<script type='text/javascript'>";
     //	echo "alert('เกิดข้อผิดพลาดในการอัปโหลดอีกครั้ง');";
     echo "</script>";
 }
 ?>