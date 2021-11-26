<?php

 $host = "localhost";
 $user = "root";
 $pass = "root";
 $db = "tcc_protp_philas";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
