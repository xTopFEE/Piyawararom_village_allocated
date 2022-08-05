<?php
require_once 'connection.php';
$db = new mysqli('127.0.0.1', 'root', '', 'project');


include 'connection.php';


$news_id = $_POST['news_id'];
// echo $news_id;

$img = $db->query("SELECT * FROM news WHERE news_id = $news_id");



// $row = $img->fetch_row();

$row = mysqli_fetch_array($img);
$image = explode("|", $row['file']);

// $db = new mysqli('127.0.0.1', 'root', '', 'project');
// $result = mysqli_query($con, "SELECT * FROM news");
// // $row = mysqli_fetch_array($result_select);
// $num = mysqli_num_rows($result); //นับแถวทั้งหมดในตารางออกมา
// $images = $db->query("SELECT * FROM news ORDER BY Date_time DESC");
// $img = $images->fetch_object();
//             $id = $img->news_id;
//             $img_file = base64_encode($img->image);
//             $img_file1 = base64_encode($img->image1);
//             $img_file2 = base64_encode($img->image2);
//             $img_file3 = base64_encode($img->image3);
//             $img_file4 = base64_encode($img->image4);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .box {
            width: 320px;
            height: 320px;

            border: 2px darkcyan;
        }

        ul {
            list-style-type: none;
            /* Remove bullets */
            padding: 0;
            /* Remove padding */
            margin: 0;
            /* Remove margins */
        }

        ul li {
            border: 1px solid #ddd;
            /* Add a thin border to each list item */
            margin-top: -1px;
            /* Prevent double borders */
            background-color: #f6f6f6;
            /* Add a grey background color */
            padding: 10px;
            /* Add some padding */
        }

        .try-text {
            text-align: center;
            position: absolute;
            top: 59%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }

        .try-image {
            background-color: #3399FF;
            height: 50px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>
    <title>ราบละเอียดข่าสสาร</title>

</head>

<body>
    <div class="try-image">
        <div class="try-text">
            <h1 style="font-size:25px">ข่าวสารของหมู่บ้าน</h1>
        </div>
    </div>
    <br><br>
    <center>
        <font size="6" face="arial">
            <h3> <?= $row['news_title'] ?>
        </font>
        </h3>
    </center>



    <br>

    <!-- <center>
        <table>
            <tr><img width='250px' height='300px' src=" admin/nav_news/<?= $row['file'] ?>" class=" card-img-top" alt="Card image cap"></tr>
            <tr><img width='250px' height='300px' src='data:image/jpg;charset=utf8;base64 , <?= $img_file2 ?>'" class=" card-img-top" alt="Card image cap"></tr>
            <td><img width='250px' height='300px' src='data:image/jpg;charset=utf8;base64 , <?= $img_file3 ?>'" class=" card-img-top" alt="Card image cap"></td>
            <td><img width='250px' height='300px' src='data:image/jpg;charset=utf8;base64 , <?= $img_file3 ?>'" class=" card-img-top" alt="Card image cap"></td>
        </table>
    </center> -->
    <?php
    $image = explode("|", $row['file']);
    $count = 0;
    $row_num = ceil(count($image) / 4);
    for ($i = 0; $i < $row_num; $i++) {
    ?>

        <div class="row">
            <?php
            $date = new DateTime($row['Date_time']); // ตรงนี้คือรูปแบบเดิมที่มีในฐานข้อมูล

            for ($j = 0; $j < 4; $j++) {
                if (isset($image[$count])) {
            ?>
                    <div class="box"> <img width='300px' height='300px' src="admin/nav_news/<?= $image[$count++] ?>"></div>
            <?php
                }
            }
            ?>
        </div>
    <?php
    }  ?>
    <br><br>
    <center>
        <h2 style="font-size:25px"> รายละเอียดข่าว : <?= $row['Description'] ?> </h2>

        <br>
        <h3 style="font-size:18px"> วันที่ : <?= $date->format('d/m/Y') ?></h3>
    </center>
    <br><br>
    <p class="a"> <a href="index.php" style="float:right;" class="btn btn-danger">ย้อนกลับ</a> </p>

</body>

</html>