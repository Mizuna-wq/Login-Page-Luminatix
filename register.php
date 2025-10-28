<?php
include("servis/database.php");
session_name("user_session");
session_start();

$register_message = "";


if (isset($_POST["Register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];   
    

    if (empty($username) || empty($password)) {
        $register_message = "Username Dan Password Tidak Boleh Kosong";
    } else {

        try {
            $sql = "INSERT INTO users (username, password, email) VALUES ('$username','$password','$email')";

            if ($db->query($sql)) {
                $register_message = "Daftar Akun Berhasil, Silahkan Login";
            } else {
                $register_message = "Daftar Akun Tidak Behasil Silahkan Coba Lagi";
            }
        } catch (mysqli_sql_exception $username) {
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
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at top, #0f2027, #203a43, #2c5364);
            color: #fff;
        }

        h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.2);
        }

        i {
            color: #ff8080;
            margin-bottom: 1rem;
            text-align: center;
            font-style: italic;
        }

        form {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            width: 320px;
            animation: fadeIn 0.8s ease-in-out;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input {
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 0.95rem;
            transition: 0.3s;
        }

        input::placeholder {
            color: #ccc;
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.15);
        }

        button {
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #ff6a00, #ee0979);
            color: white;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }

        button:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #ff8800, #ff1a9b);
            box-shadow: 0 0 10px rgba(255, 97, 0, 0.6);
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: #ccc;
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        a{
            color: #0a33e8ff;
            font-weight: bold; 
        }
    </style>

</head>

<body>

    <h3>Register</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="post">
        <input type="text" placeholder="Username" name="username">
        <input type="password" placeholder="Password" name="password">
        <input type="text" placeholder="Email" name="email">
        <button type="submit" name="Register">Daftar Sekarang</button>
          <p>Sudah Memiliki Akun?<a href="index.php">Login</a></p>
    </form>
    <?php include "layout/footer.html" ?>
</body>

</html>