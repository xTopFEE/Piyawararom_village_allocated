<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "กรุณาล็อกอินก่อน";
    header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
                <a href="./Backend.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="./nav_user/user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">ผู้ใช้งาน</span>
                </a>
                <span class="tooltip">ผู้ใช้งาน</span>
            </li>
            <li>
                <a href="./nav_director/director.php">
                    <i class='bx bx-group'></i>
                    <span class="links_name">กรรมการ</span>
                </a>
                <span class="tooltip">กรรมการ</span>
            </li>
            <li>
                <a href="./nav_admin/admin.php">
                    <i class='bx bx-code-block'></i>
                    <span class="links_name">แอดมิน</span>
                </a>
                <span class="tooltip">แอดมิน</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-file'></i>
                    <span class="links_name">แบบฟอร์มเอกสาร</span>
                </a>
                <span class="tooltip">แบบฟอร์มเอกสาร</span>
            </li>
            <li>
                <a href="./nav_news/news.php">
                    <i class='bx bx-broadcast'></i>
                    <span class="links_name">ข่าวสารประชาสัมพันธ์</span>
                </a>
                <span class="tooltip">ข่าวสารประชาสัมพันธ์</span>
            </li>
            <li>
                <a href="./nav_petition/petition.php">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">การร้องเรียนทั่วไป</span>
                </a>
                <span class="tooltip">การร้องเรียนทั่วไป</span>
            </li>
            <li>
                <a href="./nav_payment/payment.php">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="links_name">การชำระเงิน</span>
                </a>
                <span class="tooltip">การชำระเงิน</span>
            </li>
            <li>
                <a href="./nav_debt/debt.php">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">ยอดค้างชำระ</span>
                </a>
                <span class="tooltip">ยอดค้างชำระ</span>
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
                    <h1 href="#">
                        <div class="profile-details">
                            <img src="../user.png" alt="profileImg">
                            <div class="name_job">
                                <div class="name"><?php echo $_SESSION['username'] ?></div>
                                <!-- RODJANAPHADIT -->
                                <div class="job">Admin</div>
                            </div>
                        </div>
                    </h1>
                    <a href="../logout.php">
                        <i class='bx bx-log-out' id="log_out"></i>
                    </a>
                </li>

            <?php endif ?>
            <!-- END -->
        </ul>
    </div>
    <section class="home-section">
        <div>
            <div class="text">การตั้งค่า</div>

            <div class="container">
                <div class="container shadow-lg bg-light py-3" style="border-radius: 12px;">
                    <h2 class='text-center'>เปลี่ยนรหัสผ่าน</h2><br>
                    <form action="setting_db.php" method="POST">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="error">
                                <h3>
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                    ?>
                                </h3>
                            </div>
                        <?php endif ?>
                        <div class="input-group">
                            <div class="container">
                                <label for="password_old">รหัสผ่านปัจจุบัน</label>
                            </div>
                            <div class="container">
                                <input type="password" name="password_old" required>
                            </div>
                        </div><br>
                        <div class="input-group">
                            <div class="container">
                                <label for="password_1">รหัสผ่านใหม่</label>
                            </div>
                            <div class="container">
                                <input type="password" name="password_1" required>
                            </div>
                        </div><br>
                        <div class="input-group">
                            <div class="container">
                                <label for="password_2">ยืนยันรหัสผ่านใหม่</label>
                            </div>
                            <div class="container">
                                <input type="password" name="password_2" required>
                            </div>
                        </div><br>
                        <div class="input-group">
                            <button type="submit" name="edit_user" class="btn">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
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