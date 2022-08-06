<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../../login.php');
}
// print_r($_SESSION);

// connect to the database
$offset = 0;
if (isset($_GET['page'])) {
    $offset = ($_GET['page'] - 1) * 20;
} else {
    $offset = 0;
}

$con = mysqli_connect("localhost", "root", "", "project");
$query = "SELECT * FROM complaint ORDER BY Date_time DESC LIMIT 20 OFFSET $offset" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);


$query_count = "SELECT * FROM complaint" or die("Error:" . mysqli_error($con));
$result_of_complaint = mysqli_query($con, $query_count);
$number_of_complaint = mysqli_num_rows($result_of_complaint);

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="./petition.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">การร้องเรียนทั่วไป</span>
                </a>
                <span class="tooltip">การร้องเรียนทั่วไป</span>
            </li>
            <li>
                <a href="../nav_debt/debt.php">
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
                                    <div class="job">กรรมการ</div>
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
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

            <script src=""></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
            <style>
                /* * {
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
                    margin-left: 2rem;
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
                } */

                @media screen and (max-width: 450px) {
                    .container {
                        width: 90%;
                    }
                }

                .modal-backdrop.fade.in {
                    display: none !important;
                }
            </style>

        </head>

        <body>
            <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                <h2 align="center">จัดการข้อมูลการร้องเรียน</h2>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="search" style="display: flex;margin-bottom: 20px;">
                            <input type="text" class="form-control" placeholder="ค้นหาเลขที่บ้าน" style="height: 20px;" id="search_text">
                            <button class="btn btn-primary" id="search_button">ค้นหา</button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div aria-label="Page navigation example" style="float: right;">

                            <?php
                            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            $page = isset($_GET['page']) ? $_GET['page'] : 0;
                            ?>
                            <ul class="pagination" style="margin-top: 0px;">
                                <?php
                                if ((isset($_GET['page']) && $_GET['page'] == 1) || !isset($_GET['page'])) {
                                ?>
                                    <li class="page-item disabled"><a class="page-link">Previous</a></li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item "><a class="page-link" href="petition.php?page=<?= $page - 1 ?>">Previous</a></li>
                                    <?php
                                }
                                for ($i = 1; $i <= ceil($number_of_complaint / 20); $i++) {
                                    if (isset($_GET['page']) && $_GET['page'] == $i) {
                                    ?>
                                        <li class="page-item active"><a class="page-link" href="petition.php?page=<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                    } else if (!isset($_GET['page']) && $i == 1) {
                                    ?>
                                        <li class="page-item active"><a class="page-link" href="petition.php?page=1"><?= $i ?></a></li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item"><a class="page-link" href="petition.php?page=<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                if ((isset($_GET['page']) && $_GET['page'] == ceil($number_of_complaint / 20)) || ceil($number_of_complaint / 20) == 1) {
                                ?>
                                    <li class="page-item disabled"><a class="page-link">Next</a></li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item"><a class="page-link" href="petition.php?page=<?= $page + 1 ?>">Next</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <form action="#" id='compliant_form' method="post" enctype="multipart/form-data">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    <h4><b>วันที่</b></h4>
                                </th>
                                <th>
                                    <h4><b>เลขที่บ้าน</b></h4>
                                </th>
                                <th>
                                    <h4><b>รูป</b></h4>
                                </th>
                                <th>
                                    <h4><b>หัวข้อ</b></h4>
                                </th>
                                <th>
                                    <h4><b>รายละเอียด</b></h4>
                                </th>
                                <th>
                                    <h4><b>สถานะ</b></h4>
                                </th>
                                <th>
                                    <h4><b>หมายเหตุ</b></h4>
                                </th>
                                <th>
                                    <h4><b>การทำงาน</b></h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody id='body_pettition'>
                            <?php
                            for ($yy = 0; $yy < count($res); $yy++) {
                                $row = $res[$yy];
                            ?>

                                <tr>
                                    <td><?= $row['Date_time'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['file'] != null) {
                                        ?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?= $row['complaint_id'] ?>">
                                                คลิกเพื่อดูรูปภาพ
                                            </button>
                                        <?php
                                        }

                                        ?>

                                        <div class="modal fade" id="exampleModalLong<?= $row['complaint_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                                                            <img src="../../user/<?= $image[$count++] ?>" alt="" style="width: 100%;height: 150px;">
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

                                    </td>
                                    <td><?= $row['complaint_tltle'] ?></td>
                                    <td><?= $row['Description'] ?></td>
                                    <td><?php
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
                                        <?= $status ?></td>
                                    <td>
                                        <input style="width: 80%;" type="text" id="callback<?= $row['complaint_id'] ?>" name="callback" value="<?= $row['Admin_callback'] != null ? $row['Admin_callback'] : 'การตอบกลับ' ?>" class="form-control" readonly></input>

                                    </td>
                                    <td><select value="<?= $row['complaint_id'] ?>" id="status<?= $row['complaint_id'] ?>" style="width: 100%;" disabled>
                                            <option <?= $row['complaint_status'] == 0 ? 'selected' : '' ?> value="0">รอดำเนินการ</option>
                                            <option <?= $row['complaint_status'] == 2 ? 'selected' : '' ?> value="2">ไม่อนุมัติ</option>
                                            <option <?= $row['complaint_status'] == 1 ? 'selected' : '' ?> value="1">ดำเนินการ</option>
                                            <option <?= $row['complaint_status'] == 3 ? 'selected' : '' ?> value="3">อนุมัติ</option>
                                        </select></td>
                                    <td class="between">
                                        <button id="hide1<?= $row['complaint_id'] ?>" type="button" class="btn btn-warning bi bi-edit" onclick="editPetition(<?= $row['complaint_id'] ?>)"><i class='fa fa-fw fa-edit'></i></button>
                                        <button id="hide2<?= $row['complaint_id'] ?>" type="button" class="btn btn-danger bi bi-trash" onclick="deletePetition(<?= $row['complaint_id'] ?>, '<?= $row['complaint_tltle'] ?>')"><i class='fa fa-fw fa-trash'></i></button>

                                        <button style="display: none;" id="show1<?= $row['complaint_id'] ?>" type="button" class="btn btn-info bi bi-save" onclick="save(<?= $row['complaint_id'] ?>)"><i class='fa fa-fw fa-save'></i></button>
                                        <button style="display: none;" id="show2<?= $row['complaint_id'] ?>" type="button" class="btn btn-danger bi bi-times" onclick="cancel(<?= $row['complaint_id'] ?>)"><i class='fa fa-fw fa-times'></i></button>

                                    </td>
                                </tr>


                            <?php } ?>

                        </tbody>
                    </table>

                </form>
            </div>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

            <script>
                $('#search_button').click(() => {

                    $.ajax({
                        url: 'includes/search_pettition.php',
                        type: 'POST',
                        data: {
                            username: $('#search_text').val()
                        },
                        success: async function(data) {
                            const response = JSON.parse(data)
                            let html = ""
                            response.forEach(element => {
                                console.log(element.file);


                                html += `<tr>
                                    <td>${element.Date_time}</td>
                                    <td>${element.username} </td>
                                    <td>`


                                if (element.file != null) {
                                    html += `<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong${element.complaint_id}">
                                                คลิกเพื่อดูรูปภาพ
                                            </button>`


                                    html += `

                                        <div class="modal fade" id="exampleModalLong${element.complaint_id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">`

                                    let image = element.file.split("|")
                                    let count = 0
                                    let row_num = Math.ceil(image.length / 4)

                                    for (let i = 0; i < row_num; i++) {

                                        html += `<div class="row">`


                                        for (let j = 0; j < 4; j++) {
                                            if (image[count]) {

                                                html += `<div class="col-md-3">
                                                                            <img src="../../user/${image[count++]}" alt="" style="width: 100%;height: 150px;">
                                                                        </div>`

                                            }
                                        }

                                        html += `</div>`

                                    }


                                    html += `</div>
                                                </div>
                                            </div>
                                        </div>`
                                }
                                html += `</td>
                                    <td>${element.complaint_tltle}</td>
                                    <td>${element.Description}</td>
                                    <td>`

                                let status = '';
                                if (element.complaint_status == 0) {
                                    status = 'รอดำเนินการ';
                                } else if (element.complaint_status == 1) {
                                    status = 'ดำเนินการ';
                                } else if (element.complaint_status == 2) {
                                    status = 'ไม่อนุมัติ';
                                } else if (element.complaint_status == 3) {
                                    status = 'อนุมัติ';
                                }

                                html += `${status}</td>
                                    <td>
                                        <input style="width: 80%;" type="text" id="callback${element.complaint_id}" name="callback" placeholder="${element.Admin_callback != null ?element.Admin_callback:'การตอบกลับ'}" class="form-control" readonly ></input>

                                    </td>
                                    <td><select value="${element.complaint_id}" id="status${element.complaint_id}" style="width: 100%;" disabled>
                                            <option ${element.complaint_status == 0 ?'selected':''}  value="0">รอดำเนินการ</option>
                                            <option ${element.complaint_status == 2 ?'selected':''} value="2">ไม่อนุมัติ</option>
                                            <option ${element.complaint_status == 1 ?'selected':''} value="1">ดำเนินการ</option>
                                            <option ${element.complaint_status == 3 ?'selected':''} value="3">อนุมัติ</option>
                                        </select></td>

                                    <td class="between">

                                        <button id="hide1${element.complaint_id}" type="button" class="btn btn-warning bi bi-edit" onclick="editPetition(${element.complaint_id})"><i class='fa fa-fw fa-edit'></i></button>
                                        <button id="hide2${element.complaint_id}" type="button" class="btn btn-danger bi bi-trash" onclick="deletePetition(${element.complaint_id}, '${element.complaint_tltle}')"><i class='fa fa-fw fa-trash'></i></button>


                                        <button style="display: none;" id="show1${element.complaint_id}" type="button" class="btn btn-info bi bi-save" onclick="save(${element.complaint_id})"><i class='fa fa-fw fa-save'></i></button>
                                        <button style="display: none;" id="show2${element.complaint_id}" type="button" class="btn btn-danger bi bi-times" onclick="cancel(${element.complaint_id})"><i class='fa fa-fw fa-times'></i></button>

                                    </td>
                                </tr>`





                            });





                            $('#body_pettition').empty()
                            $('#body_pettition').append(html)
                        },
                        error: function(err) {}
                    });

                })
            </script>

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
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

        </head>

        <body style="font-family:roboto,sans-serif;">

            <br>
            <br>
            <br>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


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

        function editPetition(id) {
            $('#show1' + id).css('display', 'block')
            $('#show2' + id).css('display', 'block')
            $('#hide1' + id).css('display', 'none')
            $('#hide2' + id).css('display', 'none')

            $('#callback' + id).removeAttr("readonly");
            $('#status' + id).removeAttr("disabled");
        }

        function save(id) {
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


        function cancel(id) {
            console.log(id);
            $('#callback' + id).attr("readonly", "true");
            $('#status' + id).attr("disabled", "true");

            $('#hide1' + id).css('display', 'block')
            $('#hide2' + id).css('display', 'block')
            $('#show1' + id).css('display', 'none')
            $('#show2' + id).css('display', 'none')
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
        // $.noConflict();
        // jQuery(document).ready(function($) {
        //     // $('#example').DataTable();
        // });
        // Code that uses other library's $ can follow here.
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