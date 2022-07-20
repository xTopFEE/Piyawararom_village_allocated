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
if(isset($_GET['year'])){
    $year = $_GET['year'];
    $_SESSION['statement_year'] = $year;
}
if(isset($_GET['month'])){
    $month = $_GET['month'];
    $_SESSION['statement_month'] = $month;
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
    <!-- Apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
                    <span class="links_name">ยอดค้างชำระรวมทุกปี</span>
                </a>
                <span class="tooltip">ยอดค้างชำระรวมทุกปี</span>
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
                <a href="./payment.php">
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
                <a href="./statement.php">
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
                                    <div class="job">กรรมการการเงิน</div>
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
        <div class="text">รายรับรายจ่าย</div>

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
                    <h2 class='text-center'>Dashboard</h2><br>
                    <div id="chart">
                    </div>

                </div>
            </div><br>

            <div class="container">
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;" id='regBox'>
                    <br>
                    <h2 class='text-center'>เพิ่มข้อมูลรายรับรายจ่าย</h2><br>
                    <div id='msgReg'></div>
                    <form action="" id='regForm' method="post"><br>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>วันที่</h4>
                                </label>
                                <div class="form-group">
                                    <input type="date" id="date" name="date" class='form-control col-sm-5 mx-auto'>
                                </div><br><br>
                            </div>
                            <div class="col">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>รายรับ</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="income" name="income" placeholder="รายรับ" class='form-control col-sm-5 mx-auto'>
                                </div><br><br>
                            </div>
                            <div class="col">
                                <label>
                                    <h4>รายจ่าย</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="expense" name="expense" placeholder="รายจ่าย" class='form-control col-sm-5 mx-auto'>
                                </div><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>
                                    <h4>ยอดคงเหลือ</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="balance" name="balance" placeholder="ยอดคงเหลือ" class='form-control col-sm-5 mx-auto' required>
                                </div><br><br>
                            </div>
                            <div class="col">
                                <label>
                                    <h4>หมายเหตุ</h4>
                                </label>
                                <div class="form-group">
                                    <input type="text" id="other" name="other" placeholder="หมายเหตุ" class='form-control col-sm-5 mx-auto'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <input type="submit" id="btnPost" value="เพิ่มข้อมูล" class='btn btn-info'>
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
                    <h2 class='text-center'>ข้อมูลรายรับรายจ่าย</h2><br>

                    <!-- <div class="row align-items-center">
                        <input type="text" id="q" name='q' placeholder="ค้นหา..." class='form-control col-sm-5 mx-auto' autocomplete='off'>
                    </div> -->
                    <br>
                    <form action="statement.php/enter_year=2565" id='regForm' method="post">
                            <?php 
                                $now = new DateTime();
                                $thisyear = $now->format("Y") +543;
                                $selectedYear = isset($_SESSION['statement_year']) ? $_SESSION['statement_year'] : '0';
                                echo "<select name='enter_year' id='enter_year' onchange='changeYearAndMonth()'>";
                                echo " <script> console.log('hello : '+$thisyear +' selectedYear :' +$selectedYear) </script> ";
                                echo "<option value='0' >ทุกปี</option>";
                                for ($thisyear ;$thisyear >= 2554; $thisyear--){
                                    if($selectedYear == $thisyear){
                                        echo "<option value='$thisyear' selected>$thisyear</option>";
                                    }else{
                                        echo "<option value='$thisyear'>$thisyear</option>";
                                    }
                                }
                                echo "</select>";
                                echo "<script>document.getElementById('enter_year').value = '$selectedYear'</script>";
                                $selectedMonth = isset($_SESSION['statement_month']) ? $_SESSION['statement_month'] : '0';
                                echo "<select name='enter_month' id='enter_month' onchange='changeYearAndMonth()'>";
                                for ($i=0 ;$i <= 12; $i++){
                                    if($i == 0){
                                        echo "<option value='0'>ทุกเดือน</option>";
                                    }else if($i == 1){
                                        echo "<option value='1'>มกราคม</option>";
                                    }else if($i == 2){
                                        echo "<option value='2'>กุมภาพันธ์</option>";
                                    }else if($i == 3){
                                        echo "<option value='3'>มีนาคม</option>";
                                    }else if($i == 4){
                                        echo "<option value='4'>เมษายน</option>";
                                    }else if($i == 5){
                                        echo "<option value='5'>พฤษภาคม</option>";
                                    }else if($i == 6){
                                        echo "<option value='6'>มิถุนายน</option>";
                                    }else if($i == 7){
                                        echo "<option value='7'>กรกฎาคม</option>";
                                    }else if($i == 8){
                                        echo "<option value='8'>สิงหาคม</option>";
                                    }else if($i == 9){
                                        echo "<option value='9'>กันยายน</option>";
                                    }else if($i == 10){
                                        echo "<option value='10'>ตุลาคม</option>";
                                    }else if($i == 11){
                                        echo "<option value='11'>พฤศจิกายน</option>";
                                    }else if($i == 12){
                                        echo "<option value='12'>ธันวาคม</option>";
                                    }
                                }
                                echo "</select>";
                                echo "<script>document.getElementById('enter_month').value = '$selectedMonth'</script>";
                            ?>          
                    </form>
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
        <script>
            function changeYearAndMonth(){
            var year = document.getElementById("enter_year").value
            var month = document.getElementById("enter_month").value
            console.log(year)
            window.location.href = './statement.php?year='+year+'&month='+month;
        }
        </script>

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
                        $('#import').attr('disabled', 'disabled');
                        $('#import').val('Importing...');
                    },
                    success: function(data) {
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