<?php
session_start();
if (!isset($_SESSION['success_message'])) {
    header("Location: Web.php");
    exit;
}

$message = $_SESSION['success_message'];
unset($_SESSION['success_message']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Berhasil!</title>
<style>
body {
    background-color: #000;
    color: lime;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100dvh;
    text-align: center;
}
a {
    background-color: #ffcc00;
    color: #000;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 8px;
    text-decoration: none;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(255,255,0,0.6);
    transition: all 0.3s ease;
}
a:hover {
    background-color: #ffe066;
}
</style>
</head>
<body>
    <h2><?= $message ?></h2>
    <a href="Web.php">Kembali ke Halaman</a>
</body>
</html>
