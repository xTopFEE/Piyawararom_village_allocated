<!doctype html>
<html>

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap css and script -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <!-- Google Font and css file -->
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="custom-style.css">
    <link rel="stylesheet" href="variables.scss">
    <link rel="stylesheet" href="css.css">

    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <style>
        /*รูปหัว*/
        .hero-image {
            background-image: url("https://cdn.discordapp.com/attachments/881086120367104030/958330459199254538/tito2.jpg");
            background-color: #cccccc;
            height: 400px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .hero-text {
            text-align: center;
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        /*กรอบข่าว*/
        .try-image {
            background-color: #6761a8;
            height: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .try-text {
            text-align: center;
            position: absolute;
            top: 59%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        p.a {
            margin-bottom: 2px;
        }

        p.cut_word {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 30px;
        }
    </style>
</head>

<body>

    <!-- NAV-BAR -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand">หมู่บ้านปิยวรารมย์ รังสิต(คลอง4)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loadform.php">แบบฟอร์ม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">เกี่ยวกับ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ติดต่อ</a>
                    </li>
                </ul>
                <form class="d-flex" action="login.php">
                    <button class="btn rounded" style="background-color: #6761A8;" type="submit">ล็อกอิน</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- BANNER -->
    <div class="hero-image">
        <div class="hero-text">

        </div>
    </div>

    <div class="try-image">
        <div class="try-text">
            <h1 style="font-size:25px">ข่าวสารของหมู่บ้าน</h1>
        </div>
    </div>






    <br>
    <div class="holder_wrap">
        <div class="holder_wrap_img">
            <?php
            include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
            $query = "SELECT * FROM news Order By Date_time DESC" or die("Error:" . mysqli_error($con));

            $result = mysqli_query($con, $query);
            $num = mysqli_num_rows($result);
            $i = 0;
            $limit = 8;

            ?>



            <div class="row">
                <?php
                while ($i < $num  && $i < $limit) {
                    $row = mysqli_fetch_array($result);
                    $baby =  explode("|", $row['file']);

                    $date = new DateTime($row['Date_time']); // ตรงนี้คือรูปแบบเดิมที่มีในฐานข้อมูล

                ?>


                    <div class="col-md-3" style="display: flex; justify-content: center; margin-bottom:40px;">
                        <!-- <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="admin/nav_news/<?= $row['file'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row['news_title'] ?></h5>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div> -->
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="admin/nav_news/<?= $baby[0] ?>" alt="Card image cap" width='300px' height='300px'>
                            <div class="card-body">
                                <p class="card-text"><?= $row['news_title'] ?>
                            </div>
                            <div class="titel">
                                <p class="card-text"> วันที่ <?= $date->format('d/m/Y') ?> </p>
                            </div>
                            <form action="about.php" method="post">
                                <input name="" type="submit" value="คลิกรายละเอียด" />
                                <input type="hidden" name="news_id" id="" value="<?= $row['news_id'] ?>">

                            </form>
                        </div>
                    </div>

                <?php $i++;
                }; ?>

                <?php


                //echo "</table>";
                //5. close connection
                mysqli_close($con);
                ?>

            </div>

        </div>
    </div>
    <br>




    <p class="a"> <a href="newsmore.php" style="float:right;" class="btn btn-danger">อ่านต่อ...</a> </p><br><br>









    <!-- bottom nav -->
    <div class="row pt-5 px-3 border-top mt-1 " style="font-size: 5px;">
        <div class="col">


            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-info" href="#"><b>เว็บแอพพลิเคชั่น</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#"><b>การจัดการหมู่บ้านจัดสรรปิยวรารมย์</b></a>
                </li>
            </ul>


        </div>
        <div class="col">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-info" href="loadform.php">แบบฟอร์ม</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="info.php">เกี่ยวกับ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="contact.php">ติดต่อ</a>
                </li>
            </ul>

        </div>
    </div>
    <nav class="nav mt-5 ml-3" style="font-size: 5px;">

    </nav>
    <hr />

    <div class="row" style="font-size: 10px;">
        <div class="col">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <span class="nav-link active text-muted font-weight-bold">หน้าแรกของเว็บเพจ</span>
                </li>
            </ul>
        </div>
    </div>
    <script>
        function ContentPage(id) {
            location.href = "about.php?id=" + id;
        }
    </script>



</body>

</html>