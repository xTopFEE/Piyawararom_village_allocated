<!doctype html>
<html>

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap css and script -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <!-- Google Font and css file -->
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="custom-style.css">
    <link rel="stylesheet" href="variables.scss">
    <link rel="stylesheet" href="css.css">

    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
    /*รูปหัว*/
    .btn-3:hover{
        background: #ff96ad;
        box-shadow: 0 0 5px #ff96ad,0 0 25px #ff96ad,0 0 50px #ff96ad,0 0 200px #ff96ad;
    }
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
        background-color: #1c1c1c;
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




<div class="try-image">
        <div class="try-text">
            <h1 style="font-size:25px">ข่าวสารของหมู่บ้าน</h1>
        </div>
    </div>
    <!-- CARD -->
   
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">เกี่ยวกับ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ติดต่อ</a>
                    </li>
                </ul>
           
            </div>
        
        </div>
    </nav>
	<div class="holder_wrap">
        <div class="holder_wrap_img">
            <?php
            include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
            $query = "SELECT * FROM news" or die("Error:" . mysqli_error($con));
            $result = mysqli_query($con, $query);
            ?>
            <div class="row">
                <?php
                while ($row = mysqli_fetch_array($result)) { 
                     $baby =  explode("|",$row['file']);
                     $date = new DateTime( $row['Date_time']); // ตรงนี้คือรูปแบบเดิมที่มีในฐานข้อมูล

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
                            <img class="card-img-top" width='300px' height='300px' src="admin/nav_news/<?= $baby[0]  ?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"><?= $row['news_title'] ?></div>

                                <div class="titel">
                                <p class="card-text"> วันที่ <?= $date->format('d/m/Y') ?> </p>
                            </div>


                                <form action="about.php" method="post">
                                <input name="" type="submit" value="คลิกรายละเอียด" />
                                <input type="hidden" name="news_id" id="" value="<?= $row['news_id'] ?>">
                    
                            </form>
                        </div>
                        
                    </div>


                <?php

                }
                //echo "</table>";
                //5. close connection
                mysqli_close($con);
                ?>

            </div>

        </div>
    </div>
<br>
<p class="a">  <a href="index.php" style="float:left;" class="btn btn-danger">BACK</a> </p><br>

</body>
</html>

