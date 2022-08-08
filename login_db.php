<?php
include('server.php');

$error = array();
$page = $_SESSION['page'] = 1;
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    echo $username;
    echo $password;

    if (empty($username)) {
        array_push($error, "กรุณาใส่ username");
    }

    if (empty($password)) {
        array_push($error, "กรุณาใส่รหัสผ่าน");
    }


    if (count($error) == 0) {
        echo $password;
        $query = "SELECT * FROM user WHERE username = '$username' AND password ='$password'";
        $result = mysqli_query($conn, $query);
        //echo strval($result);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['usertype'] = "user"; // add $_SESSION['usertype']
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
            header("location: user/nav_backend/backend.php");
        } else if (mysqli_num_rows($result) == 0) {
            echo $password;
            $query = "SELECT * FROM adminn WHERE username = '$username' AND password ='$password'";
            $result = mysqli_query($conn, $query);
            //echo strval($result);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['usertype'] = "admin"; // add $_SESSION['usertype']
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                header("location: admin/nav_backend/backend.php");
                
            } else if (mysqli_num_rows($result) == 0) {
                echo $password;
                $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='6'";
                $result = mysqli_query($conn, $query);
                //echo strval($result);

                if (mysqli_num_rows($result) == 1) {
                    $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                    header("location: director/nav_backend/backend.php");
                } else if (mysqli_num_rows($result) == 0) {
                    echo $password;
                    $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='4'";
                    $result = mysqli_query($conn, $query);
                    //echo strval($result);

                    if (mysqli_num_rows($result) == 1) {
                        $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                        $_SESSION['username'] = $username;
                        $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                        header("location: financial_director/nav_backend/backend.php");
                    } else if (mysqli_num_rows($result) == 0) {
                        echo $password;
                        $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='2'";
                        $result = mysqli_query($conn, $query);
                        //echo strval($result);

                        if (mysqli_num_rows($result) == 1) {
                            $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                            $_SESSION['username'] = $username;
                            $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                            header("location: financial_director/nav_backend/backend.php");
                        } else if (mysqli_num_rows($result) == 0) {
                            echo $password;
                            $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='1'";
                            $result = mysqli_query($conn, $query);
                            //echo strval($result);

                            if (mysqli_num_rows($result) == 1) {
                                $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                                $_SESSION['username'] = $username;
                                $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                header("location: director/nav_backend/backend.php");
                            } else if (mysqli_num_rows($result) == 0) {
                                echo $password;
                                $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='3'";
                                $result = mysqli_query($conn, $query);
                                //echo strval($result);

                                if (mysqli_num_rows($result) == 1) {
                                    $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                                    $_SESSION['username'] = $username;
                                    $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                    header("location: director/nav_backend/backend.php");
                                } else if (mysqli_num_rows($result) == 0) {
                                    echo $password;
                                    $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='5'";
                                    $result = mysqli_query($conn, $query);
                                    //echo strval($result);

                                    if (mysqli_num_rows($result) == 1) {
                                        $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                                        $_SESSION['username'] = $username;
                                        $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                        header("location: director/nav_backend/backend.php");
                                    } else if (mysqli_num_rows($result) == 0) {
                                        echo $password;
                                        $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='7'";
                                        $result = mysqli_query($conn, $query);
                                        //echo strval($result);
    
                                        if (mysqli_num_rows($result) == 1) {
                                            $_SESSION['usertype'] = "director"; // add $_SESSION['usertype']
                                            $_SESSION['username'] = $username;
                                            $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                            header("location: director/nav_backend/backend.php");
                                        } else {
                                            array_push($error, "username หรือ รหัสผ่าน ของคุณผิด!");
                                            $_SESSION['error'] = "username หรือ รหัสผ่าน ของคุณผิด!";
                                            header("location: Login.php");
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        array_push($error, "กรุณาใส่ username หรือ password");
        $_SESSION['error'] = "กรุณาใส่ username หรือ password";
        header("location: login.php");
    }
}
