<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../../login.php');
}
// print_r($_SESSION);
// connect to the database
$con = mysqli_connect("localhost", "root", "", "project");
$query = "SELECT * FROM complaint" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
?>
<style>
    button, select {
        text-transform: none;
        border-radius: 7px;
        background-color: #FFEBCD;
    }
</style>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                <a href="../Backend.php">
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
        <div class="text">การร้องเรียนทั่วไป</div>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>

        <body>
            <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                <h2 align="center">จัดการข้อมูลการร้องเรียน</h2>
                <br>
                <form action="#" id='compliant_form' method="post" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <div class="row">
                                <div class="col-1 text-center">
                                    วันที่
                                </div>
                                <div class="col-1 text-center">
                                    <h4><b>บ้านที่ร้องเรียน</b></h4>
                                </div>
                                <div class="col-2 text-center">
                                    <h4><b>รูป</b></h4>
                                </div>
                                <div class="col-1 text-center">
                                    <h4><b>หัวข้อ</b></h4>
                                </div>
                                <div class="col-2 text-center">
                                    <h4><b>รายละเอียด</b></h4>
                                </div>
                                <div class="col-1 text-center">
                                    <h4><b>สถานะ</b></h4>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive" style="padding-bottom: 60px;">
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>

                                    <div class="row mt-1">
                                        <div class="col-1 text-center">
                                            <?= $row['Date_time'] ?>
                                        </div>
                                        <div class="col-1 text-center">
                                            <?= $row['username'] ?>
                                        </div>
                                        <div class="col-2 text-center">
                                            รูป
                                        </div>
                                        <div class="col-1 text-center">
                                            <?= $row['complaint_tltle'] ?>
                                        </div>
                                        <div class="col-2 text-center">
                                            <?= $row['Description'] ?>
                                        </div>
                                        <div class="col-1 text-center 
                            
                            <?php
                                    if ($row['complaint_status'] == 0) {
                            ?>
                                text-warning
                            <?php } ?>
                            <?php
                                    if ($row['complaint_status'] == 1) {
                            ?>
                                text-primary
                            <?php } ?>
                            <?php
                                    if ($row['complaint_status'] == 2) {
                            ?>
                                text-danger
                            <?php } ?>
                            <?php
                                    if ($row['complaint_status'] == 3) {
                            ?>
                                text-success
                            <?php } ?>
                            
                            ">
                                            <?php
                                            $status = '';
                                            if ($row['complaint_status'] == 0) {
                                                $status = 'รอดำเนินการ';
                                            } else if ($row['complaint_status'] == 1) {
                                                $status = 'ดำเนินการ';
                                            } else if ($row['complaint_status'] == 2) {
                                                $status = 'ไม่อนุมัติ';
                                            } else if ($row['complaint_status'] == 3) {
                                                $status = 'อนุมัติ';
                                            }
                                            ?>
                                            <?= $status ?>
                                        </div>
                                        <div class="col-1">
                                            <select value="<?= $row[0] ?>" id="status<?= $row[0] ?>" onchange="changeStatus(<?= $row[0] ?>)" style="width: 100%;">
                                                <option <?= $row['complaint_status'] == 0 ? 'selected' : '' ?> value="0">รอดำเนินการ</option>
                                                <option <?= $row['complaint_status'] == 2 ? 'selected' : '' ?> value="2">ไม่อนุมัติ</option>
                                                <option <?= $row['complaint_status'] == 1 ? 'selected' : '' ?> value="1">ดำเนินการ</option>
                                                <option <?= $row['complaint_status'] == 3 ? 'selected' : '' ?> value="3">อนุมัติ</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" id="callback<?= $row[0] ?>" name="callback" placeholder="<?= $row['Admin_callback'] != null ? $row['Admin_callback'] : 'การตอบกลับ' ?>" class="form-control" onkeyup="myCallBack(<?= $row[0] ?>)"></input>
                                        </div>
                                        

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        </body>

        <?php
        if (isset($_POST['callback'])) {
            echo $_POST['callback'];
        }

        ?>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- <title>สถานะการร้องเรียน</title> -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        </head>

        <body style="font-family:roboto,sans-serif;">

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
            echo "<script> window.location.href = './user.php' </script>";
        }
    } else if (isset($_GET['back'])) {
        if ($_SESSION['page'] > 0) {
            $_SESSION['page'] -= 20;
            echo "<script> window.location.href = './user.php' </script>";
        }
    } else if (isset($_GET['page'])) {
        $goPage = $_GET['page'];
        $_SESSION['page'] = ($goPage * 20) - 20;
        echo "<script> console.log(' get page = '+ $goPage);</script>";
    } else if (isset($_GET['clear_page'])) {
        $_SESSION['page'] = 0;
        echo "<script> window.location.href = './user.php' </script>";
    }

    ?>

    <script>
        function deletePetition(id, name) {


            Swal.fire({
                title: 'ต้องการที่จะลบข้อมูล?',
                showCancelButton: true,
                confirmButtonText: 'ลบข้อมูล',
                denyButtonText: 'ยกเลิก',
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: 'includes/delete.php',
                        type: 'POST',
                        data: {
                            id
                        },
                        success: async function(data) {
                            await Swal.fire('ลบข้อมูลแล้ว!', '', 'success')
                            window.location.reload()
                        },
                        error: function(err) {
                            Swal.fire('ลบข้อมูลไม่สำเร็จ!', '', 'error')
                        }
                    });

                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })

        }

        function changeStatus(id) {
            $.ajax({
                url: 'includes/edit.php',
                type: 'POST',
                data: {
                    complaint_status: $('#status' + id).val(),
                    admin_callback: $('#callback' + id).val(),
                    complaint_id: id
                },
                success: function(data) {
                    window.location.reload()
                }
            });
        }
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
    <script>
        let timeout = null;

        function myCallBack(id) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                $.ajax({
                    url: 'includes/edit.php',
                    type: 'POST',
                    data: {
                        complaint_status: $('#status' + id).val(),
                        admin_callback: $('#callback' + id).val(),
                        complaint_id: id
                    },
                    success: function(data) {
                        window.location.reload()
                    }
                });
            }, 1000);

        }
    </script>
</body>

</html>