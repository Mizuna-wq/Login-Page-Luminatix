<?php
$hostname ="localhost";
$username = "root";
$password = "";
$database = "users";

$db =  mysqli_connect($hostname, $username, $password,$database);

if($db->connect_error){
    echo"Koneksi Database Error";
    die("ERROR!");
}


?>