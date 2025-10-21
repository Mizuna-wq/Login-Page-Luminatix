<?php
session_start();
if(isset($_POST ["logout"])){
    session_unset();
    session_destroy();
    header("location: index.php");
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
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: #f4f6f9;
    color: #0e3fc8ff;
}


header, footer {
    background-color: #00aeffff;
    color: white;
    padding: 15px;
    text-align: center;
}


.container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}


h3 {
    color: #d2d8dfff;
    margin-bottom: 20px;
}


button {
    background: #e74c3c;
    border: none;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s;
}

button:hover {
    background: #c0392b;
}

footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #2c3e50;
    color: white;
    text-align: center;
    padding: 10px;
}

    </style>
</head>
<body>
 <?php include"layout/header.html" ?>

    <div class="container">
    <h3>Selamat Datang <?= $_SESSION["username"] ?></h3>
    <form action="dashboard.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    </div>

<?php include"layout/footer.html" ?>
</body>
</html>