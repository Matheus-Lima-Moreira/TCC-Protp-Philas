<?php

//  $host = "localhost";
//  $user = "root";
//  $pass = "";
//  $db = "bd_philas";

$host = "servidorphiladelpho.com";
$user = "servid06_phila";
$pass = "Phila@123";
$db = "servid06_banco10";

$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}
