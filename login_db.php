<?php
include('server.php');

$error = array();

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
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
            header("location: user/Backend.php");
        } else if (mysqli_num_rows($result) == 0) {
            echo $password;
            $query = "SELECT * FROM adminn WHERE username = '$username' AND password ='$password'";
            $result = mysqli_query($conn, $query);
            //echo strval($result);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                header("location: admin/Backend.php");
            } else if (mysqli_num_rows($result) == 0) {
                echo $password;
                $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='director'";
                $result = mysqli_query($conn, $query);
                //echo strval($result);

                if (mysqli_num_rows($result) == 1) {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                    header("location: director/Backend.php");
                } else if (mysqli_num_rows($result) == 0) {
                    echo $password;
                    $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='financial_director'";
                    $result = mysqli_query($conn, $query);
                    //echo strval($result);

                    if (mysqli_num_rows($result) == 1) {
                        $_SESSION['username'] = $username;
                        $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                        header("location: financial_director/Backend.php");
                    } else if (mysqli_num_rows($result) == 0) {
                        echo $password;
                        $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='vice_president_financial'";
                        $result = mysqli_query($conn, $query);
                        //echo strval($result);
    
                        if (mysqli_num_rows($result) == 1) {
                            $_SESSION['username'] = $username;
                            $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                            header("location: financial_director/Backend.php");
                        } else if (mysqli_num_rows($result) == 0) {
                            echo $password;
                            $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='president'";
                            $result = mysqli_query($conn, $query);
                            //echo strval($result);
        
                            if (mysqli_num_rows($result) == 1) {
                                $_SESSION['username'] = $username;
                                $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                header("location: director/Backend.php");
                            } else if (mysqli_num_rows($result) == 0) {
                                echo $password;
                                $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='vice_president_civil'";
                                $result = mysqli_query($conn, $query);
                                //echo strval($result);
            
                                if (mysqli_num_rows($result) == 1) {
                                    $_SESSION['username'] = $username;
                                    $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                    header("location: director/Backend.php");
                                } else if (mysqli_num_rows($result) == 0) {
                                    echo $password;
                                    $query = "SELECT * FROM director WHERE username = '$username' AND password ='$password' AND rank ='director_public_relations'";
                                    $result = mysqli_query($conn, $query);
                                    //echo strval($result);
                
                                    if (mysqli_num_rows($result) == 1) {
                                        $_SESSION['username'] = $username;
                                        $_SESSION['success'] = "คุณได้เข้าสู่ระบบ";
                                        header("location: director/Backend.php");
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
    } else {
        array_push($error, "กรุณาใส่ username หรือ password");
        $_SESSION['error'] = "กรุณาใส่ username หรือ password";
        header("location: login.php");
    }
}
