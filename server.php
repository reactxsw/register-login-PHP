<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smilewin";

    $connect = mysqli_connect($servername,$username,$password,$dbname);
    if (!$connect) {
        die("Unable to connect to server" . mysqli_connect_error());
    }
?>