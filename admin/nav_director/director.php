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
                <a href="../nav_backend/backend.php?clear_page=true">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">ยอดค้างชำระรวมทุกปี</span>
                </a>
                <span class="tooltip">ยอดค้างชำระรวมทุกปี</span>
            </li>
            <li>
                <a href="../nav_user/user.php?clear_page=true">
                    <i class='bx bx-user'></i>
                    <span class="links_name">สมาชิกในหมู่บ้าน</span>
                </a>
                <span class="tooltip">สมาชิกในหมู่บ้าน</span>
            </li>
            <li>
                <a href="director.php?clear_page=true">
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
                <a href="../nav_downloadform/downloadform.php">
                    <i class='bx bxs-download'></i>
                    <span class="links_name">แบบฟอร์มสำหรับดาวโหลด</span>
                </a>
                <span class="tooltip">แบบฟอร์มสำหรับดาวโหลด</span>
            </li>
            <li>
                <a href="../nav_form/form.php?clear_page=true">
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
                <a href="../nav_payment/payment.php?clear_page=true">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="links_name">การชำระเงิน</span>
                </a>
                <span class="tooltip">การชำระเงิน</span>
            </li>
            <li>
                <a href="../nav_debt/debt.php?clear_page=true">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">ยอดค้างชำระ</span>
                </a>
                <span class="tooltip">ยอดค้างชำระ</span>
            </li>
            <li>
                <a href="../nav_statement/statement.php">
                    <i class='bx bxs-calculator'></i>
                    <span class="links_name">รายรับรายจ่าย</span>
                </a>
                <span class="tooltip">รายรับรายจ่าย</span>
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
        <div class="text">กรรมการ</div>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>

        <!--
        <body>
             <div class="container">
                <br />
                <div class="container bg-light py-3">
                    <h2 align="center">Upload ไฟล์ข้อมูลสมาชิกในหมู่บ้านเพื่อใช้สำหรับการเข้าสู่ระบบ</h2>
                    <br />
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">นำเข้าข้อมูลจากไฟล์ Excel หรือ CSV</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <span id="message"></span>
                            <form method="post" id="import_excel_form" enctype="multipart/form-data">
                                <table class="table">
                                    <tr>
                                        <td width="50%"><input type="file" name="import_excel" /></td>
                                        <td width="25%"><input type="submit" name="import" id="import" class="btn btn-primary" value="Upload" /></td>
                                    </tr>
                                </table>
                            </form>
                            <br />

                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        </body>
        -->

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>สมาชิกในหมู่บ้าน</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        </head>

        <body>

            <div class="container">
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;" id='regBox'>
                    <br>
                    <h2 class='text-center'>เพิ่มข้อมูลกรรมการ</h2><br>
                    <div id='msgReg'></div>
                    <form action="" id='regForm' method="post" enctype="multipart/form-data"><br>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>username</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="username" name="username" placeholder="username" class='form-control col-sm-5 mx-auto' required>
                                </div><br><br>
                            </div>
                            <div class="col">
                                <label>
                                    <h4>รหัสผ่าน</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="password" name="password" placeholder="รหัสผ่าน" class='form-control col-sm-5 mx-auto' required>
                                </div><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>ชื่อ-นามสกุล</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="fullname" name="fullname" placeholder="ชื่อ-นามสกุล" class='form-control col-sm-5 mx-auto' required>
                                </div><br><br>
                            </div>
                            <div class="col">
                                <label>
                                    <h4>ยืนยันรหัสผ่าน</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="password_2" name="password_2" placeholder="ยืนยันรหัสผ่าน" class='form-control col-sm-5 mx-auto' required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>ตำแหน่ง</h4>
                                </label><br>
                                <select name="rank" id="rank">
                                    <option value="1" selected>ประธานกรรมการ</option>
                                    <option value="2">รองประธานกรรมการ ฝ่ายการเงิน</option>
                                    <option value="3">รองประธานกรรมการ ฝ่ายโยธา</option>
                                    <option value="4">กรรมการและเหรัญญิก</option>
                                    <option value="5">กรรมการฝ่ายประชาสัมพันธ์</option>
                                    <option value="6">กรรมการและเลขานุการ</option>
                                    <option value="7">กรรมการตำแหน่งอื่นๆ</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>
                                    <h4>รูปภาพกรรมการ</h4>
                                </label><br>
                                <div class="form-group">
                                    <input type="file" name="upload" id="upload"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <input type="submit" id="btnPost" value="เพิ่มข้อมูลกรรมการ" class='btn btn-info'>
                            </div>
                        </div>                    
                    </form>
                    <br>

                </div>
            </div>
            </div>

            <div class="container">
                <br>
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                    <?php
                    // echo $_SESSION['page'];
                    ?>
                    <br>
                    <h2 class='text-center'>ข้อมูลกรรมการ</h2><br>

                    <div class="row align-items-center">
                        <input type="text" id="q" name='q' placeholder="ค้นหา..." class='form-control col-sm-5 mx-auto' autocomplete='off'>
                    </div>
                    <br>
                    <div class="row align-items-center">
                        <div id="msg" class='mx-auto'></div>
                    </div>

                    <!-- Center Table -->
                    <div style="display:flex; justify-content:center;">
                        <div id="table" class='text-center mx-auto'></div>
                    </div>
                    <!-- Center Table -->

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

            <br> <br>
            <!-- <form action='./user.php' id='' method='GET'><input type='submit' id='page' value='20' class='btn btn-info' name='page'></form> <br> -->
            <!-- <a href='./user.php?page=20'><input type='submit' id='' value='ถัดไป' class='btn btn-info'></a> <br> -->
            </div>
            <br>
            <br>
            <br>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/main.js"></script>


    </section>
    <?php
    function testalet()
    {
        echo "<script> alert('hello')</script>";
    }
    ?>


    <?php
    if (isset($_GET['next'])) {
        if ($_SESSION['page'] + 20 < $length) {
            $_SESSION['page'] += 20;
            echo "<script> window.location.href = './director.php' </script>";
        }
    } else if (isset($_GET['back'])) {
        if ($_SESSION['page'] > 0) {
            $_SESSION['page'] -= 20;
            echo "<script> window.location.href = './director.php' </script>";
        }
    } else if (isset($_GET['page'])) {
        $goPage = $_GET['page'];
        $_SESSION['page'] = ($goPage * 20) - 20;
        echo "<script> console.log(' get page = '+ $goPage);</script>";
    } else if (isset($_GET['clear_page'])) {
        $_SESSION['page'] = 0;
        echo "<script> window.location.href = './director.php' </script>";
    }

    ?>

    <script>
        // $("#nextpage").on('submit', function() {
        //     <?php
                //         $_SESSION['page'] = $_SESSION['page'] + 20;
                //         
                ?>
        // });
        // $("#backpage").on('submit', function() {
        //     <?php
                //         $_SESSION['page'] = $_SESSION['page'] - 20;
                //         
                ?>
        // });
    </script>

    <script>
        function hidepass(test) {
            console.log(test);
            var fullhide_pass_id = "hide_pass_" + test;
            var x = document.getElementById(fullhide_pass_id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#import_excel_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "import.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        console.log('asdfasdfasdfasd');
                        $('#import').attr('disabled', 'disabled');
                        $('#import').val('Importing...');
                    },
                    success: function(data) {
                        console.log('asdfasdfasdfasd222');
                        $('#message').html(data);
                        $('#import_excel_form')[0].reset();
                        $('#import').attr('disabled', false);
                        $('#import').val('Import');
                    }
                })
            });
        });
    </script>

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