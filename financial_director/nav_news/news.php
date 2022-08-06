<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../../login.php');
}

$con = mysqli_connect("localhost", "root", "", "project");
$query = "SELECT * FROM news ORDER BY news_id  DESC" or die("Error:" . mysqli_error($con));
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
                <a href="./news.php">
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

        </ul>
    </div>

    <section class="home-section">
        <div class="text">หัวข้อข่าวสาร</div>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="dist/image-uploader.min.css">

            <style>
                /* .container {
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

                .modal-backdrop.fade.show {
                    display: none !important;
                }
            </style>
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
                            <form action="#" method="post" name="news_form" id="news_form" enctype="multipart/form-data"><br>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>หัวข้อข่าวสาร</h4>
                                        </label>
                                        <div class="form-group">

                                            <input type="hidden" id="action" name="action" value="register"></input>
                                            <input type="hidden" id="id" name="id"></input>
                                            <input type="hidden" id="old_img" name="old_img" value="0"></input>
                                            <input type="text" id="title" name="title" placeholder="หัวข้อข่าวสาร" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รายละเอียดข่าวสาร</h4>
                                        </label>
                                        <div class="form-group">
                                            <textarea type="text" id="description" name="description" placeholder="รายละเอียดข่าวสาร" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <h4>รูปที่เกี่ยวข้องกับข่าวสาร</h4>
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
                                        <button id="submit2" value="เพิ่มข่าวสาร" class='btn btn-info'>เพิ่มข่าวสาร</button>
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
                $('#submit2').text('แก้ไขข้อมูลข่าวสาร')
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


                $query = "INSERT into news (news_title,Description,file) 
                VALUES ('$title','$description','" . $path_all . "')" or die("Error:" . mysqli_error($con));
                $result = mysqli_query($con, $query);
                echo '<script>window.location.href = \'news.php\'</script>';
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

                $query = "UPDATE news SET news_title = '" . $title . "',Description = '" . $description . "' , file = '" . $path_all . "' where news_id = '" . $_POST['id'] . "'";
                $result = mysqli_query($con, $query);
                echo '<script>window.location.href = \'news.php\'</script>';
            }
        }
        ?>


        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>ข้อมูลข่าวสาร</title>
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

                    <h2 class='text-center'>ข้อมูลข่าวสาร</h2><br>
                    <br>
                    <div class="row align-items-center">
                        <div id="msg" class='mx-auto'></div>
                    </div>


                    <div class="row" id="" class='text-center mx-auto'>
                        <div class="col-1 text-center">
                            <h4><b>วันที่</b></h4>
                        </div>
                        <div class="col-3 text-center">
                            <h4><b>รูป</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>หัวข้อข่าวสาร</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>รายละเอียดข่าวสาร</b></h4>
                        </div>
                        <div class="col-2 text-center">
                            <h4><b>การทำงาน</b></h4>
                        </div>
                    </div>
                    <hr>
                    <?php
                    while ($row = mysqli_fetch_array($result_select)) {
                    ?>
                        <div class="row" id="" class='text-center mx-auto '>
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
                                            <div class="">
                                                <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="">
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
                                                }  ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <?= $row['news_title'] ?>
                            </div>
                            <div class="col-2 text-center">
                                <?= $row['Description'] ?>
                            </div>


                            <div class="col-2 text-center">
                                <button type="button" class="btn btn-success bi bi-trash" onclick="editPetition(<?= $row[0] ?>, '<?= $row['news_title'] ?>', '<?= $row['Description'] ?>','<?= $row['file'] ?>' )"><i class='fa fa-fw fa-edit'></i></button>
                                <button type="button" class="btn btn-danger bi bi-trash" onclick="deletePetition(<?= $row[0] ?>, '<?= $row['news_title'] ?>')"><i class='fa fa-fw fa-trash'></i></button>
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
        $('#submit2').click(function(e) {
            let edit = $('#submit2').text()
            let titter = "ต้องการที่จะเพิ่มข้อมูล"
            let titter2 = "ยืนยัน"

            if (edit == "เพิ่มข้อมูลการร้องเรียน") {
                titter = "ต้องการที่จะเพิ่มข้อมูล"
                titter2 = "ยืนยัน"
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

                    if (edit == "แก้ไขข้อมูลข่าวสาร") {
                        let $form = $(".uploaded")
                        let $inputImages = $form.find('img');

                        const old = []
                        for (let file of $inputImages) {
                            if (file.currentSrc.search("uploads") != -1)
                                old.push(file.currentSrc.substring(file.currentSrc.search("uploads")))
                        }
                        $("#old_img").val(old.join('|'))
                    }


                    $("#news_form").submit(); //ให้มันเพิ่มลงform
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        })



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