<?php
include('server.php');

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login_style.css">
    <!-- Comfirm box -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>หมู่บ้านปิยวรารมย์ คลอง4</span></div>
            <form action="login_db.php" method="POST">
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                        <?php
                        echo "<a>";
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        echo "</a>";
                        ?>
                    </div>
                <?php endif ?>

                <div class="row">
                    <i class='bx bx-home'></i>
                    <input type="text" name="username" placeholder="บ้านเลขที่" required>
                </div>
                <div class="row">
                    <i class='bx bx-key'></i>
                    <input type="password" name="password" placeholder="รหัสผ่าน" required>
                </div>
                <div class="pass"><a onclick="forgot();" href="#">ลืมรหัสผ่าน?</a></div>
                <div class="row button">
                    <input type="submit" value="เข้าสู่ระบบ" name="login_user">
                </div>

            </form>
        </div>
    </div>

</body>

</html>
<script>
    function forgot() {
        Swal.fire(
            'หากคุณลืมรหัสผ่าน',
            'กรุณาติดต่อ โทร 02-152-2774 หรือ 092-929-1956',
            'info'
        )
    }
</script>