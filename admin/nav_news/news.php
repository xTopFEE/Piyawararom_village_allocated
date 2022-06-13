<?php require_once "includes/db.php";
class user extends db
{
    public function getLength()
    {
        $lengthquery = "SELECT * FROM director";
        $stmtlength = $this->connect()->prepare($lengthquery);
        $stmtlength->execute();
        $length = 0;
        while ($row = $stmtlength->fetch(PDO::FETCH_ASSOC)) {
            $length++;
        }
        return $length;
    }
}
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Comfirm box -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-home-alt icon'></i>
            <div class="logo_name">หมู่บ้านปิยวรารมย์</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../nav_backend/backend.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../nav_user/user.php?clear_page=true">
                    <i class='bx bx-user'></i>
                    <span class="links_name">สมาชิกในหมู่บ้าน</span>
                </a>
                <span class="tooltip">สมาชิกในหมู่บ้าน</span>
            </li>
            <li>
                <a href="../nav_director/director.php?clear_page=true">
                    <i class='bx bx-group'></i>
                    <span class="links_name">กรรมการ</span>
                </a>
                <span class="tooltip">กรรมการ</span>
            </li>
            <li>
                <a href="../nav_admin/admin.php">
                    <i class='bx bx-code-block'></i>
                    <span class="links_name">แอดมิน</span>
                </a>
                <span class="tooltip">แอดมิน</span>
            </li>
            <li>
                <a href="../nav_form/form.php">
                    <i class='bx bx-file'></i>
                    <span class="links_name">แบบฟอร์มเอกสาร</span>
                </a>
                <span class="tooltip">แบบฟอร์มเอกสาร</span>
            </li>
            <li>
                <a href="../nav_news/news.php">
                    <i class='bx bx-broadcast'></i>
                    <span class="links_name">ข่าวสารประชาสัมพันธ์</span>
                </a>
                <span class="tooltip">ข่าวสารประชาสัมพันธ์</span>
            </li>
            <li>
                <a href="../nav_petition/petition.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">การร้องเรียนทั่วไป</span>
                </a>
                <span class="tooltip">การร้องเรียนทั่วไป</span>
            </li>
            <li>
                <a href="../nav_payment/payment.php">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="links_name">การชำระเงิน</span>
                </a>
                <span class="tooltip">การชำระเงิน</span>
            </li>
            <li>
                <a href="../nav_debt/debt.php">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">ยอดค้างชำระ</span>
                </a>
                <span class="tooltip">ยอดค้างชำระ</span>
            </li>
            <li>
                <a href="../setting.php">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">การตั้งค่า</span>
                </a>
                <span class="tooltip">การตั้งค่า</span>
            </li>
            <!-- Logged in user detail -->
            <?php if (isset($_SESSION['username'])) : ?>

                <li class="profile">
                    <div class="profile_content">
                        <h1 href="#">
                            <div class="profile-details">
                                <img src="./user.png" alt="profileImg">
                                <div class="name_job">
                                    <div class="name"><?php echo $_SESSION['username'] ?></div>
                                    <!-- RODJANAPHADIT -->
                                    <div class="job">Admin</div>
                                </div>
                            </div>
                        </h1>
                        <a href="../../logout.php">
                            <i class='bx bx-log-out' id="log_out"></i>
                        </a>
                    </div>
                </li>

            <?php endif ?>
            <!-- END -->
        </ul>
    </div>
    <section class="home-section">
        <div class="text">ข่าวสารประชาสัมพันธ์</div>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>


        <body>
            <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                <br />
                <div class="container">
                    <h2 align="center">Upload ไฟล์หัวข้อข่าวสาร</h2>
                    <br />
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">นำเข้าข้อมูลจากไฟล์ที่ต้องการ</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <span id="message"></span>
                            <form action="add_file_db.php" id='import_excel_form' method="post" enctype="multipart/form-data"><br>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รูปหัวข่าว</h4>
                                        </label>
                                        <div class="form-group">
                                            <td width="50%"><input type="file" name="fileupload" id="fileupload" required="required" /></td>
                                        </div><br>
                                    </div>
                                    <div class="col">
                                        <label>
                                            <h4>หัวข้อข่าวสาร</h4>
                                        </label>
                                        <div class="form-group">
                                            <input type="text" id="headlines1" name="headlines1" placeholder="หัวข้อข่าวสาร" class='form-control col-sm-5 mx-auto' required>
                                        </div><br><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รายละเอียดข่าวสาร</h4>
                                        </label>
                                        <div class="form-group">
                                            <textarea type="text" id="news1" name="news1" placeholder="รายละเอียดข่าวสาร" class="form-control col-sm-9 mx-auto"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <input type="submit" id="import" value="เพิ่มข้อมูลข่าวสาร" class='btn btn-info'>
                                    </div>
                                </div>
                                <br />
                        </div>
                    </div>
                </div>

            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

        </body>


        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>ข่าวสารประชาสัมพันธ์</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        </head>

        <body style="font-family:roboto,sans-serif;">
            <!-- <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                <br>
                <div>

                    <h2 class='text-center'>ข้อมูลข่าวสาร</h2><br>

                    <div class="row align-items-center">
                        <input type="text" id="q" name='q' placeholder="ค้นหา..." class='form-control col-sm-5 mx-auto' autocomplete='off'>
                    </div>
                    <div class="row align-items-center">
                        <div id="msg" class='mx-auto'></div>
                    </div> 
                   
                    <br>
                    <br>   
                    <?php
                    //1. เชื่อมต่อ database: 
                    include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
                    //2. query ข้อมูลจากตาราง: 
                    $query = "SELECT * FROM uploadfile" or die("Error:" . mysqli_error($con));
                    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result . 
                    $result = mysqli_query($con, $query);
                    //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล: 
                    echo "<table border='1' align='center' width='100%'>";
                    echo "<tr align='center' bgcolor=''>
                                <td>ลำดับที่</td>
                                <td>id</td>
                                <td>รูปภาพ</td>
                                <td>หัวข้อข่าวสาร</td>
                                <td>รายละเอียดข่าวสาร</td>
                                <td>วันที่</td>
                                <td>การทำงาน</td>
                              </tr>";
                    //หัวข้อตาราง
                    $i = 1;
                    echo "<tr align='center' bgcolor=''></tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td align='center'>" . $i++ . "</td> ";
                        echo "<td align='center'>" . $row['id'];
                        echo "<td align='center'>" . "<img src='fileupload/" . $row['fileupload'] . "' width='100'>" . "</td>";
                        echo "<td align='center'>" . $row['headlines1'];
                        echo "<td align='center'>" . $row['news1'];
                        echo "<td align='center'>" . $row['dateup'];

                        //ลบข้อมูล
                        echo "<td align='center'>
                        <a href='edit.php?id=$row[1]' type='button' class='btn btn-info' onclick=\"return confirm('ยืนยันการแก้ไขข้อมูล')\">แก้ไข</a>
                        <a href='UserDelete.php?id=$row[1]' type='button' class='btn btn-danger' onclick=\"return confirm('ยืนยันการลบข้อมูล')\">ลบ</a></td></td> ";
                        echo "</tr>";
                    }
                    echo "</table>";
                    //5. close connection
                    mysqli_close($con);
                    ?>
                   

                    <br>
                    <a href='?back=true'>
                        <input type='submit' id='backpage' value='ย้อนกลับ' class='btn btn-info'>
                    </a>
                    

                    <a href='?next=true'>
                        <input type='submit' id='nextpage' name="nextpage" value='ถัดไป' class='btn btn-info'>
                    </a>

                </div>

            </div> -->
            
            <div class="container">
                <br>
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                    <?php
                    // echo $_SESSION['page'];
                    ?>

                    <h2 class='text-center'>ข้อมูลแอดมิน</h2><br>

                    <!-- <div class="row align-items-center">
                        <input type="text" id="q" name='q' placeholder="ค้นหา..." class='form-control col-sm-5 mx-auto' autocomplete='off'>
                    </div> -->
                    <br>
                    <div class="row align-items-center">
                        <div id="msg" class='mx-auto'></div>
                    </div>

                    <div id="table" class='text-center mx-auto '></div>

                    <br>

                    <a href='?back=true'>
                        <input type='submit' id='backpage' value='ย้อนกลับ' class='btn btn-info'>
                    </a>
                    <?php
                    $user = new user;
                    $page = 0;
                    $length = $user->getLength();
                    for ($i = 1; $i <= $length; $i++) {
                        if ($i % 20 == 0) {
                            $page++;
                            echo "<a href='?page=$page'> <input type='submit' id='backpage' value='$page' class='btn btn-info'></a>";
                        }
                    }
                    if ($length % 20 != 0) {
                        $lastpage = $page + 1;
                        echo "<a href='?page=$lastpage'> <input type='submit' id='backpage' value='$lastpage' class='btn btn-info'></a>";
                    }

                    $testvar = $_SESSION['page'];
                    echo "<script> console.log('page = '+$testvar + ' length = '+ $length);</script>";

                    ?>
                    <a href='?next=true'>
                        <input type='submit' id='nextpage' name="nextpage" value='ถัดไป' class='btn btn-info'>
                    </a>

                </div>
            </div>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/main.js"></script>


    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function
        });

        // following are the code to change sidebar button
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
</body>

</html>