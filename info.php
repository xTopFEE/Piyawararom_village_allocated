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
        .hero-image2 {
            background-image: url("https://cdn.discordapp.com/attachments/881086120367104030/958330459199254538/tito2.jpg");
            background-color: #cccccc;
            height: 400px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .hero-text2 {
            text-align: center;
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }
        /*กรอบข่าว*/
        .try-image2 {
            background-color: #EE7621;
            height: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
        .try-text2 {
            text-align: center;
            position: absolute;
            top: 59%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
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
                        <a class="nav-link active" href="info.php">เกี่ยวกับ</a>
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
    <div class="hero-image2">
        <!-- <div class="row align-items-center">
            <div class="col">
                <div class="col-md-4 text-light offset-1">
                    <h1 class="display-7 fw-bolder"><font color="#000000"> ติดต่อ </font></h1> 
                    <p class="lead">เว็บแอพพลิเคชั่นหมู่บ้านจัดสรรปิยวรารมย์</p>
                </div>
            </div>
        </div> -->
    </div>


    <div class="try-image2">
        <div class="try-text2">
            <h1 style="font-size:25px">เกี่ยวกับ</h1>
        </div>
    </div>


   

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
                    <span class="nav-link active text-muted font-weight-bold">เกี่ยวกับ</span>
                </li>
            </ul>
        </div>
    </div>




</body>

</html>