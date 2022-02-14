<?php
    session_start();

    // initializing variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // connect to the database
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    

    if (!$conn) {
        die("connection failed" . mysqli_connect_error());
    } else {
        //echo "Connected success";
    }
?>