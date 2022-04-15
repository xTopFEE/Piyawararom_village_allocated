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


    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /*รูปหัว*/
        .hero-image1 {
            background-image: url("https://cdn.discordapp.com/attachments/881086120367104030/958330459199254538/tito2.jpg");
            background-color: #cccccc;
            height: 400px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .hero-text1 {
            text-align: center;
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        /*กรอบข่าว*/
        .try-image1 {
            background-color: #6761a8;
            height: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .try-text1 {
            text-align: center;
            position: absolute;
            top: 59%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        .a1 {
            height: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .atext1 {
            text-align: center;
            position: absolute;
            top: 450%;
            left: 50%;
            transform: translate(-50%, -50%);
          
        }

        
    </style>
</head>

<body>

    <!-- NAV-BAR -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand">หมู่บ้านปิยวรารมย์</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">เกี่ยวกับ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact.php">ติดต่อ</a>
                    </li>
                </ul>
                <form class="d-flex" action="login.php">
                    <button class="btn rounded" style="background-color: #6761A8;" type="submit">ล็อกอิน</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- BANNER -->
    <div class="hero-image1">
        <!-- <div class="row align-items-center">
            <div class="col">
                <div class="col-md-4 text-light offset-1">
                    <h1 class="display-7 fw-bolder"><font color="#000000"> ติดต่อ </font></h1> 
                    <p class="lead">เว็บแอพพลิเคชั่นหมู่บ้านจัดสรรปิยวรารมย์</p>
                </div>
            </div>
        </div> -->
    </div>


    <div class="try-image1">
        <div class="try-text1">
            <h1 style="font-size:25px">ติดต่อ</h1>
        </div>
    </div>

    <!-- ข้อความติดต่อ -->
    <!-- details of this page -->
    <div class="contenter"><br><br>
        <center>
            <h1 style="font-size:25px" >หมู่บ้านปิยวรารมย์</h1><br>
            <h4 style="font-size:16px" >ที่อยู่: ถนนไสวประชาราษฎร์ ตำบลบึงยี่โถ อำเภอธัญบุรี ปทุมธานี 12130</h4><br>
            <i class='bx bx-time-five'style="font-size:16px"> เวลาทำการ 08:30-17:00 น.</i><br>
            <i class='bx bxs-phone' style="font-size:16px"> โทร 02-152-2774 หรือ 092-929-1956</i><br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d990398.8825733615!2d100.47558500660959!3d14.151046437839087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x311d7eeb023c2501%3A0x740f1d3ed1807b50!2z4Lir4Lih4Li54LmI4Lia4LmJ4Liy4LiZ4Lib4Li04Lii4Lin4Lij4Liy4Lij4Lih4Lii4LmMIOC4hOC4peC4reC4hyA0!3m2!1d13.984588299999999!2d100.6850264!5e0!3m2!1sth!2sth!4v1642947833859!5m2!1sth!2sth" width="90%" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </center>
    </div><br>
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
                    <a class="nav-link text-info" href="index.php">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="info.php">เกี่ยวกับ</a>
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
                    <span class="nav-link active text-muted font-weight-bold">ติดต่อ</span>
                </li>
            </ul>
        </div>
    </div>




</body>

</html>