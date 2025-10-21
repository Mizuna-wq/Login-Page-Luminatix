<?php
include("servis/database.php");
session_start();

$login_message = "";

if (isset($_SESSION["is_login"])) {
    header("Location: Web.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
   

    if (empty($username) || empty($password)) {
        $login_message = "Username dan Password tidak boleh kosong";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $db->query($sql);

        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            
            $_SESSION["username"] = $data["username"];
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["is_login"] = true;

            header("Location: Web.php");
            exit;
        } else {
            $login_message = "Akun tidak ditemukan";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LuminaTIX</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #74ABE2, #5563DE);
        }

        form {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 300px;
            justify-content: center;
        }

        input {
            padding: 0.7rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
        }

        button {
            padding: 0.7rem;
            border: none;
            border-radius: 8px;
            background: #5563DE;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #3342a3;
        }

        h3 {
            color: white;
            margin-bottom: 1rem;
            text-align: center;
        }

        i {
            color: red;
            text-align: center;
            display: block;
            margin-bottom: 1rem;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #111;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h3>Login</h3>
    <i><?= $login_message ?></i>
    <form action="index.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
    <?php include "layout/header.html" ?>
    <?php include "layout/footer.html" ?>
</body>

</html>