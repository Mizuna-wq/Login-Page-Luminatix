<?php
include("servis/database.php");
session_start();

$register_message = "";


if (isset($_SESSION["is_login"])) {
    header("location: web.php");
}

if (isset($_POST["Register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

if(empty($username) || empty($password)){
    $register_message = "Username Dan Password Tidak Boleh Kosong";
}else{

try {
      $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";

    if($db->query($sql)){
        $register_message = "Daftar Akun Berhasil, Silahkan Login";
    }else{
        $register_message ="Daftar Akun Tidak Behasil Silahkan Coba Lagi";
    }

 } catch (mysqli_sql_exception $e) {
    $register_message = "Username Sudah Digunakan";
 }
}
$db->close();
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background: #0077cc;
    color: #fff;
    padding: 15px;
    text-align: center;
}

main {
    padding: 20px;
    text-align: center;
}

h3 {
    text-align: center;
    margin-top: 30px;
    color: #2f3640;
}

i {
    display: block;
    text-align: center;
    color: red;
    margin-bottom: 15px;
}

form {
    background: #ffffff;
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

form input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #dcdde1;
    border-radius: 8px;
    font-size: 14px;
}

form input:focus {
    outline: none;
    border-color: #0984e3;
    box-shadow: 0 0 5px rgba(9,132,227,0.5);
}

button {
    width: 100%;
    padding: 10px;
    background: #0984e3;
    border: none;
    color: #fff;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #74b9ff;
}

footer {
    margin-top: auto;
    text-align: center;
    padding: 15px;
    background: #dfe6e9;
}

    </style>

</head>
<body>
    <?php include "layout/header.html"?>
    <h3>Daftar Dulu Gan</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="post">
        <input type="text" placeholder="Username" name="username">
        <input type="password" placeholder="Password" name="password">
        <button type="submit" name="Register">Daftar Sekarang</button>
    </form>
    <?php include "layout/footer.html"?>
</body>
</html>