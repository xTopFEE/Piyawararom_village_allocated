<?php
session_start();
$username = $_SESSION["username"];/* userid of the user */

// connect to the database
$conn = mysqli_connect("localhost", "root", "", "project");

$errors = array();

if (isset($_POST['edit_user'])) {
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $password_old = $_POST['password_old'];
    
    //if (password_old)
    if (empty($password_1)) {
        array_push($errors, "กรุณาใส่รหัสผ่าน");
        $_SESSION['error'] = "กรุณาใส่รหัสผ่าน";
        header("location: setting.php");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "รหัสผ่านไม่ตรงกัน");
        $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        header("location: setting.php");
    }
    if (count($errors) == 0) {

        $sql = "UPDATE user SET password='$password_1' WHERE username='$_SESSION[username]'";
        mysqli_query($conn, $sql);
        header("location: setting.php");
    }
}
