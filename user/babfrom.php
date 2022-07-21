<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../login.php');
}
// print_r($_SESSION);

// connect to the database
// include('connection.php');
$con = mysqli_connect("localhost", "root", "", "project");
$query = "SELECT * FROM complaint WHERE username = '" . $_SESSION['username'] . "' ORDER BY complaint_id  DESC" or die("Error:" . mysqli_error($con));
$result_select = mysqli_query($con, $query);
// print_r(mysqli_fetch_array($result_select));
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .text-center {
        font-size: 12px;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-home-alt icon'></i>
            <div class="logo_name">หมู่บ้านปิยวรารมย์</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="./nav_backend/backend.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">ยอดค้างชำระรวมทุกปี</span>
                </a>
                <span class="tooltip">ยอดค้างชำระรวมทุกปี</span>
            </li>
            <li>
                <a href="./nav_debt/debt.php">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">ยอดค้างชำระ</span>
                </a>
                <span class="tooltip">ยอดค้างชำระ</span>
            </li>
            <li>
                <a href="./nav_form/form.php">
                    <i class='bx bx-file'></i>
                    <span class="links_name">แบบฟอร์มเอกสาร</span>
                </a>
                <span class="tooltip">แบบฟอร์มเอกสาร</span>
            </li>
            <li>
                <a href="babfrom.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">การร้องเรียนทั่วไป</span>
                </a>
                <span class="tooltip">การร้องเรียนทั่วไป</span>
            </li>
            <li>
                <a href="../nav_statement/statement.php">
                    <i class='bx bxs-calculator'></i>
                    <span class="links_name">รายรับรายจ่าย</span>
                </a>
                <span class="tooltip">รายรับรายจ่าย</span>
            </li>
            <li>
                <a href="./setting.php">
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
                                <img src="../user.png" alt="profileImg">
                                <div class="name_job">
                                    <div class="name"><?php echo $_SESSION['username'] ?></div>
                                    <!-- RODJANAPHADIT -->
                                    <div class="job">สมาชิกในหมู่บ้าน</div>
                                </div>
                            </div>
                        </h1>
                        <a href="../logout.php">
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
            <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="dist/image-uploader.min.css">


            <style>
                * {
                    margin: 0;
                    padding: 0;
                    font-weight: normal;
                }

                body {
                    font-family: 'Lato', sans-serif;
                    font-size: 16px;
                    font-weight: 300;
                    color: rgba(0, 0, 0, 0.9);
                    line-height: 1.5;
                }

                header {
                    background-color: rgba(0, 0, 0, 0.9);
                    color: rgb(255, 255, 255);
                    padding: 1rem;
                }

                header p {
                    font-family: 'Montserrat', sans-serif;
                    font-size: 1.2em;
                    font-weight: 200;
                    margin-bottom: 4rem;
                }

                main {
                    text-align: justify;
                    position: relative;
                    margin: 4rem 0;
                }

                footer {
                    background-color: rgba(0, 0, 0, 0.9);
                    color: rgb(255, 255, 255);
                    padding: 1rem 0;
                    margin-top: 4rem;
                }

                footer p {
                    text-align: center;
                    font-family: 'Montserrat', sans-serif;
                    font-size: 1em;
                    font-weight: 200;
                    margin: 0;
                }

                a {
                    color: #50ce7d;
                    text-decoration: none;
                }

                h1,
                h4,
                h6 {
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 600;
                }

                h1 {
                    font-size: 3.6em;
                    margin: 4rem 0 1rem 0;
                }

                h4 {
                    font-size: 2em;
                    margin: 3rem 0 1rem 0;
                }

                h6 {
                    font-size: 1.2em;
                    margin: 1rem 0;
                }

                h4 small {
                    font-size: 70%;
                    font-weight: 300;
                }

                p {
                    margin: 1rem 0;
                }

                nav {
                    position: absolute;
                    margin-left: -12em;
                }

                nav ul {
                    margin-left: 0;
                    list-style: none;
                }

                nav ul li {
                    padding: .2rem 0;
                }

                nav ul li a {
                    font-size: 1.2em;
                    font-weight: 400;
                    font-family: 'Montserrat', sans-serif;
                    color: #2196f3;
                }

                pre {
                    font-family: 'Source Code Pro', monospace;
                    margin: 1rem 0;
                    padding: 1rem 1rem;
                    background: #f3f3f3;
                    font-size: .9em;
                    overflow-x: scroll;
                }

                table code,
                p code {
                    font-family: 'Source Code Pro', monospace;
                    background: #f3f3f3;
                    font-size: .9em;
                    padding: .1rem .3rem;
                }

                strong {
                    font-weight: 600;
                }

                form>button {
                    -webkit-appearance: none;
                    cursor: pointer;
                    font-family: 'Montserrat', sans-serif;
                    font-weight: 600;
                    padding: 1rem 2rem;
                    border: none;
                    background-color: #50ce7d;
                    color: #fff;
                    text-transform: uppercase;
                    display: block;
                    margin: 2rem 0 2rem auto;
                    font-size: 1em;
                }

                ul {
                    margin-left: 0px !important;
                }

                input {
                    background-color: transparent;
                    border: none;
                    border-radius: 0;
                    outline: none;
                    width: 100%;
                    line-height: normal;
                    font-size: 1em;
                    padding: 0;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                    -webkit-box-sizing: content-box;
                    box-sizing: content-box;
                    margin: 0;
                    color: rgba(0, 0, 0, 0.72);
                    background-position: center bottom, center calc(100% - 1px);
                    background-repeat: no-repeat;
                    background-size: 0 2px, 100% 1px;
                    -webkit-transition: background 0s ease-out 0s;
                    -o-transition: background 0s ease-out 0s;
                    transition: background 0s ease-out 0s;
                    background-image: -webkit-gradient(linear, left top, left bottom, from(#2196f3), to(#2196f3)), -webkit-gradient(linear, left top, left bottom, from(#d9d9d9), to(#d9d9d9));
                    background-image: -webkit-linear-gradient(#2196f3, #2196f3), -webkit-linear-gradient(#d9d9d9, #d9d9d9);
                    background-image: -o-linear-gradient(#2196f3, #2196f3), -o-linear-gradient(#d9d9d9, #d9d9d9);
                    background-image: linear-gradient(#2196f3, #2196f3), linear-gradient(#d9d9d9, #d9d9d9);
                    height: 2.4em;
                }

                input:focus {
                    background-size: 100% 2px, 100% 1px;
                    outline: 0 none;
                    -webkit-transition-duration: 0.3s;
                    -o-transition-duration: 0.3s;
                    transition-duration: 0.3s;
                    border-bottom: none;
                    -webkit-box-shadow: none;
                    box-shadow: none;
                }

                .input-field label {
                    width: 100%;
                    color: #9e9e9e;
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    font-size: 1em;
                    cursor: text;
                    -webkit-transition: -webkit-transform .2s ease-out;
                    transition: -webkit-transform .2s ease-out;
                    -webkit-transform-origin: 0 100%;
                    transform-origin: 0 100%;
                    text-align: initial;
                    -webkit-transform: translateY(7px);
                    transform: translateY(7px);
                    pointer-events: none;
                }

                input:focus+label {
                    color: #2196f3;
                }

                .input-field {
                    position: relative;
                    margin-top: 2.2rem;
                }

                .input-field label.active {
                    -webkit-transform: translateY(-15px) scale(0.8);
                    transform: translateY(-15px) scale(0.8);
                    -webkit-transform-origin: 0 0;
                    transform-origin: 0 0;
                }

                .container {
                    width: 60%;
                    max-width: 1200px;
                    margin: 0 auto;
                    position: relative;
                }

                .step {
                    font-size: 1.6em;
                    font-weight: 600;
                    margin-right: .5rem;
                }

                .option {
                    margin-top: 2rem;
                    border-bottom: 1px solid #d9d9d9;
                }

                .modal {
                    position: fixed;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    background: rgba(0, 0, 0, .5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .modal .content {
                    background: #fff;
                    display: inline-block;
                    padding: 2rem;
                    position: relative;
                }

                .modal .content h4 {
                    margin-top: 0;
                }

                .modal .content a.close {
                    position: absolute;
                    top: 1rem;
                    right: 1rem;
                    color: inherit;
                }

                ::-webkit-scrollbar {
                    width: 10px;
                    height: 10px;
                }

                ::-webkit-scrollbar-track {
                    background: transparent;
                }

                ::-webkit-scrollbar-thumb {
                    background: #888;
                }

                ::-webkit-scrollbar-thumb:hover {
                    background: #555;
                }

                @media screen and (max-width: 1366px) {
                    body {
                        font-size: 15px;
                    }

                    nav ul li a {
                        font-size: 1.1em;

                    }
                }

                @media screen and (max-width: 992px) {
                    main {
                        margin: 2rem 0;
                    }

                    nav {
                        margin-left: -10em;
                    }
                }

                @media screen and (max-width: 786px) {
                    body {
                        font-size: 14px;
                    }

                    nav {
                        display: none;
                    }

                    .container {
                        width: 80%;
                    }
                }

                @media screen and (max-width: 450px) {
                    .container {
                        width: 90%;
                    }
                }

                .modal-backdrop.fade.show {
                    display: none !important;
                }
            </style>
        </head>


        <body>
            <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                <br />
                <div class="container">
                    <h2 align="center">Upload ไฟล์การร้องเรียน</h2>
                    <br />
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">นำเข้าข้อมูลจากไฟล์ที่ต้องการ</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <span id="message"></span>
                            <form action="#" method="post" name="compliant_form" id="compliant_form" enctype="multipart/form-data"><br>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>เรื่องที่ต้องการร้องเรียน</h4>
                                        </label>
                                        <div class="form-group">

                                            <input type="hidden" id="action" name="action" value="register"></input>
                                            <input type="hidden" id="id" name="id"></input>
                                            <input type="hidden" id="old_img" name="old_img" value="0"></input>
                                            <input type="text" id="title" name="title" placeholder="เรื่องที่ต้องการร้องเรียน" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รายละเอียดการร้องเรียน</h4>
                                        </label>
                                        <div class="form-group">
                                            <textarea type="text" id="description" name="description" placeholder="รายละเอียดการร้องเรียน" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รูปที่เกี่ยวข้องกับการร้องเรียน</h4>
                                        </label>
                                        <div class="form-group">
                                            <td width="50%">
                                                <div class="input-field">
                                                    <div class="input-images-1" style="padding-top: .5rem;"></div>
                                                </div>

                                            </td>
                                        </div><br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        <button id="submit2" value="เพิ่มข้อมูลการร้องเรียน" class='btn btn-info'>เพิ่มข้อมูลการร้องเรียน</button>
                                    </div>
                                </div>
                                <br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <form action="#" method="post" id="form_to_update">
                <input type="hidden" id="title2" name="title2">
                <input type="hidden" id="id2" name="id2">
                <input type="hidden" id="do_update2" name="do_update2">
                <input type="hidden" id="description2" name="description2">
                <input type="hidden" id="img2" name="img2">
            </form>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="dist/image-uploader.min.js"></script>
        </body>

        <script>
            <?php
            if (!isset($_POST['do_update2'])) {
            ?>
                $('.input-images-1').imageUploader();
            <?php
            } else {
            ?>
                $('#title').val('<?= $_POST['title2'] ?>')
                $('#id').val(<?= $_POST['id2'] ?>)
                $('#action').val('update')
                $('#description').val('<?= $_POST['description2'] ?>')
                $('#submit2').text('แก้ไขข้อมูลการร้องเรียน')
                let img = '<?= $_POST['img2'] ?>'
                if (img != '') {
                    let arr_img = img.split("|")
                    let preloaded = arr_img.map((img, index) => {
                        return {
                            id: index,
                            src: img
                        }
                    });
                    $('.input-images-1').imageUploader({
                        preloaded: preloaded,
                        preloadedInputName: 'old'
                    });
                } else {
                    $('.input-images-1').imageUploader();
                }
            <?php
            }
            ?>
        </script>

        <?php
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['action'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            if ($_POST['action'] == "register") {
                $countfiles = count($_FILES['images']['name']);
                $upload_location = "uploads/";
                $files_arr = array();
                for ($index = 0; $index < $countfiles; $index++) {
                    $filename = $_FILES['images']['name'][$index];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $valid_ext = array("png", "jpeg", "jpg");
                    if (in_array($ext, $valid_ext)) {
                        $path = $upload_location . $filename;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $path)) {
                            $files_arr[] = $path;
                        }
                    }
                }

                $path_all = implode("|", $files_arr);


                $query = "INSERT into complaint (complaint_tltle,complaint_status,Description,username,file) 
                VALUES ('$title','0','$description','" . $_SESSION['username'] . "','" . $path_all . "')" or die("Error:" . mysqli_error($con));
                $result = mysqli_query($con, $query);
                echo '<script>window.location.href = \'babfrom.php\'</script>';
            } elseif ($_POST['action'] == "update") {

                $countfiles = count($_FILES['images']['name']);
                $upload_location = "uploads/";
                $files_arr = array();
                for ($index = 0; $index < $countfiles; $index++) {
                    $filename = $_FILES['images']['name'][$index];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $valid_ext = array("png", "jpeg", "jpg");
                    if (in_array($ext, $valid_ext)) {
                        $path = $upload_location . $filename;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $path)) {
                            $files_arr[] = $path;
                        }
                    }
                }

                if ($_POST['old_img'] != "0") {
                    if (count($files_arr) == 0) {
                        $path_all = $_POST['old_img'];
                    } else {
                        $path_all = implode("|", $files_arr) . "|" . $_POST['old_img'];
                    }
                } else {
                    $path_all = implode("|", $files_arr);
                }

                $query = "UPDATE complaint SET complaint_tltle = '" . $title . "',Description = '" . $description . "' , file = '" . $path_all . "' where complaint_id = '" . $_POST['id'] . "'";
                $result = mysqli_query($con, $query);
                echo '<script>window.location.href = \'babfrom.php\'</script>';
            }
        }
        ?>


        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>การร้องเรียนทั่วไป</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        </head>

        <body style="font-family:roboto,sans-serif;">

            <div class="container">
                <br>
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                    <?php
                    // echo $_SESSION['page'];
                    ?>

                    <h2 class='text-center'>ข้อมูลการร้องเรียน</h2><br>
                    <br>
                    <div class="row align-items-center">
                        <div id="msg" class='mx-auto'></div>
                    </div>


                    <div class="row" id="table" class='text-center mx-auto'>
                        <div class="col-1 text-center">
                            <h4><b>วันที่</b></h4>
                        </div>
                        <div class="col-3 text-center">
                            <h4><b>รูป</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>หัวข้อ</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>รายละเอียด</b></h4>
                        </div>
                        <div class="col-1 text-center">
                            <h4><b>สถานะ</b></h4>
                        </div>
                        <div class="col-1 text-center">
                            <h4><b>หมายเหตุ</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>การทำงาน</b></h4>
                        </div>
                    </div>
                    <hr>

                    <?php
                    while ($row = mysqli_fetch_array($result_select)) {
                    ?>

                        <div class="row" id="table" class='text-center mx-auto '>
                            <div class="col-1 text-center">
                                <?= $row['Date_time'] ?>
                            </div>
                            <div class="col-3 text-center">

                                <?php
                                if ($row['file'] != null) {
                                ?>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?= $row[0] ?>">
                                        คลิกเพื่อดูรูปภาพ
                                    </button>
                                <?php
                                }

                                ?>

                                <div class="modal fade" id="exampleModalLong<?= $row[0] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $image = explode("|", $row['file']);
                                                $count = 0;
                                                $row_num = ceil(count($image) / 4);
                                                for ($i = 0; $i < $row_num; $i++) {
                                                ?>
                                                    <div class="row">
                                                        <?php
                                                        for ($j = 0; $j < 4; $j++) {
                                                            if (isset($image[$count])) {
                                                        ?>
                                                                <div class="col-md-3">
                                                                    <img src="<?= $image[$count++] ?>" alt="" style="width: 100%;height: 150px;">
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }

                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <?= $row['complaint_tltle'] ?>
                            </div>
                            <div class="col-2 text-center">
                                <?= $row['Description'] ?>
                            </div>
                            <div class="col-1 text-center <?php
                                                            if ($row['complaint_status'] == 0) {
                                                            ?>
                                text-warning
                            <?php
                                                            } ?>
                            <?php
                            if ($row['complaint_status'] == 1) {
                            ?>
                                text-primary
                            <?php
                            } ?>
                            <?php
                            if ($row['complaint_status'] == 2) {
                            ?>
                                text-danger
                            <?php
                            } ?>
                            <?php
                            if ($row['complaint_status'] == 3) {
                            ?>
                                text-success
                            <?php
                            } ?>
                            
                            ">
                                <?php
                                if ($row['complaint_status'] == 0) {
                                    $status = 'รอดำเนินการ';
                                } elseif ($row['complaint_status'] == 1) {
                                    $status = 'ดำเนินการ';
                                } elseif ($row['complaint_status'] == 2) {
                                    $status = 'ไม่อนุมัติ';
                                } elseif ($row['complaint_status'] == 3) {
                                    $status = 'อนุมัติ';
                                } ?>
                                <?= $status ?>
                            </div>
                            <div class="col-1 text-center">
                                <?= $row['Admin_callback'] ?>
                            </div>
                            <div class="col-2 text-center">
                                <button type="button" class="btn btn-success bi bi-trash" onclick="editPetition(<?= $row[0] ?>, '<?= $row['complaint_tltle'] ?>', '<?= $row['Description'] ?>','<?= $row['file'] ?>' )"><i class='fa fa-fw fa-edit'></i></button>
                                <button type="button" class="btn btn-danger bi bi-trash" onclick="deletePetition(<?= $row[0] ?>, '<?= $row['complaint_tltle'] ?>')"><i class='fa fa-fw fa-trash'></i></button>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/main.js"></script>


    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let submit2 = document.querySelector("#submit2");


        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });


        $('#submit2').click(function(e) {
            let edit = $('#submit2').text()
            let titter = "ต้องการที่จะแก้ข้อมูล"
            let titter2 = "แก้ไข"

            if (edit == "เพิ่มข้อมูลการร้องเรียน") {
                titter = "ต้องการที่จะเพิ่มข้อมูล"
                titter2 = "เพิ่ม"
            }

            e.preventDefault() //ให้มันอยุ่นาน
            e.stopPropagation();

            Swal.fire({
                title: titter,
                showCancelButton: true,
                confirmButtonText: titter2,
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {

                if (result.isConfirmed) {

                    if (edit == "แก้ไขข้อมูลการร้องเรียน") {
                        let $form = $(".uploaded")
                        let $inputImages = $form.find('img');

                        const old = []
                        for (let file of $inputImages) {
                            if (file.currentSrc.search("uploads") != -1)
                                old.push(file.currentSrc.substring(file.currentSrc.search("uploads")))
                        }
                        $("#old_img").val(old.join('|'))
                    }


                    $("#compliant_form").submit(); //ให้มันเพิ่มลงform
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        })

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }

        function deletePetition(id, name) {


            Swal.fire({
                title: 'ต้องการที่จะลบข้อมูล?',
                showCancelButton: true,
                confirmButtonText: 'ลบข้อมูล',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: 'delete.php',
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

        function editPetition(id, title, desc, img) {
            $("#title2").val(title)
            $("#id2").val(id)
            $("#do_update2").val(true)
            $("#description2").val(desc)
            $("#img2").val(img)
            $("#form_to_update").submit();

        }
    </script>

</body>

</html>