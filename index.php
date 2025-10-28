<?php
include("servis/database.php");
session_name('user_session');
session_start();

$login_message = "";

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
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - LuminaTIX</title>
  <link rel="stylesheet" href="style/index.css" />
</head>

<body>
  <video autoplay loop playsinline muted class="bg-video">
    <source src="Background.mp4" type="video/mp4" />
  </video>
  <header class="logo">
    <h1>LuminaTIX</h1>
  </header>
  <div class="wrapper">
    <form action="index.php" method="POST">
      <h1>Login</h1>
      <div class="login-message">
        <i><?= $login_message ?></i>
      </div>
      <div class="input-box">
        <input type="text" name="username" placeholder="username" />
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="password" />
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox" /> Remember me</label>
        <a href="#">Forgot Password?</a>
      </div>
      <button type="submit" class="btn" name="login">Login</button>
      <div class="footer">
        <p>Belum Memiliki Akun? <a href="register.php">Register</a></p>
        <p>Login Sebagai ADMIN <a href="loginAdmin.php">Login</a></p>
      </div>
    </form>
  </div>

  <script>
    const video = document.querySelector(".bg-video");
    const logo = document.querySelector(".logo");
    const wrapper = document.querySelector(".wrapper");
    let shown = false;

    video.addEventListener("timeupdate", () => {
      if (video.currentTime >= 6 && !shown) {
        shown = true;
        logo.classList.add("show");
        setTimeout(() => {
          wrapper.classList.add("show");
        }, 5.8); // jeda dikit biar animasi muncul bertahap
      }
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const loginBerhasil = false;

        if (loginBerhasil) {
          // kalau berhasil -> redirect 
          window.location.href = "Web.php";
        } else {
          // kalau gagal -> munculkan ulang box dengan animasi translateY (fadeInUp)
          // pendekatan yang bersih: reset class animasi, lalu tambah lagi
          wrapper.classList.remove("show");
          void wrapper.offsetWidth; // trick untuk reset animasi CSS
          wrapper.classList.add("show");

          // optional: beri fokus ke input username biar user bisa cepat ketik ulang
          const firstInput = form.querySelector('input[type="text"], input');
          if (firstInput) firstInput.focus();
        }
      });
  </script>
</body>

</html>