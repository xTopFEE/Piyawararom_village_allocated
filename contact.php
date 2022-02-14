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
                        <a class="nav-link active" href="#">ติดต่อ</a>
                    </li>
                </ul>
                <form class="d-flex" action="login.php">
                    <button class="btn rounded" style="background-color: #6761A8;" type="submit">ล็อกอิน</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- BANNER -->
    <div class="bg-image" style="
    background-image: url('img/vill_4.jpg');
    height: 305px ; background-size: 100%; padding-top: 100px;
  ">
        <div class="row align-items-center">
            <div class="col">
                <div class="col-md-4 text-light offset-1">
                    <h1 class="display-7 fw-bolder">ติดต่อ</h1>
                    <!-- <p class="lead">เว็บแอพพลิเคชั่นหมู่บ้านจัดสรรปิยวรารมย์</p> -->
                </div>
            </div>
        </div>

    </div>

    <!-- details of this page -->
    <div class="contenter">

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
                    <a class="nav-link text-info" href="info.php">เกี่ยวกับ</a>
                </li>
            </ul>

        </div>
        <div class="col">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">การช่วยเหลือ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="login.php">ผู้ดูแล</a>
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