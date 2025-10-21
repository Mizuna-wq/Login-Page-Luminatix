<?php
session_start();
if (isset($_POST["logout"])) {
  session_unset();
  session_destroy();
  header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LuminaTIX - Pesan Tiket Bioskop</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #f9f9f9;
      color: #333;
    }

    header {
      background: #111;
      color: rgb(255, 255, 255);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav {
      display: flex;
      align-items: center;
      background-color: #111;
      padding: 10px 30px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      margin-right: 25px;
    }

    nav a:hover {
      color: #ffcc00;
      transition: transform 0.5s;
      transform: translateY(-5px);
    }

    .logout {
      background-color: #ff4d4d;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .logout:hover {
      background-color: #e60000;
    }

    header h1 {
      font-size: 1.5rem;
      color: #f39c12;
    }
    header p{
      font-size: 1.2rem;
      text-align: end;
    }

    nav a {
      color: white;
      margin-left: 1rem;
      text-decoration: none;
    }

    .hero {
      background: url("https://picsum.photos/1200/400?movie") center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 7rem 2rem;
    } 

    .hero h2 {
      font-size: 2rem;
      margin-bottom: 0.6rem;
    }

    .hero button {
      background: #f39c12;
      color: rgb(255, 255, 255);
      border: none;
      padding: 0.7rem 1.5rem;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 8px;


    }

    section {
      padding: 2rem;
    }

    section h2 {
      margin-bottom: 1rem;
    }


    .movie-slider {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      scroll-behavior: smooth;
      padding-bottom: 1rem;
      scroll-snap-type: x mandatory;
    }

    .movie-card {
      flex: 0 0 180px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 380px;

    }

    .movie-slider::-webkit-scrollbar {
      display: none;
    }

    .movie-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
    }

    .movie-card h3 {
      margin: 0.5rem;
      font-size: 0.95rem;
      flex-grow: 1;
      text-align: center;
    }

    .movie-card button {
      background: #ff9d00;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      margin: 0.8rem auto 1rem auto;
      cursor: pointer;
      border-radius: 5px;
    }

    .movie-card form {
      display: flex;
      margin-bottom: 0;
    }

    footer {
      background: #111;
      color: white;
      text-align: center;
      padding: 1rem;
      margin-top: 2px;
      position: relative;
    }
  </style>
  <link rel="icon" type="image/png" href="TIXID_app_icon.png">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
  <header data-aos="fade-down">
    <div data-aos="fade-down">
      <h1>LuminaTIX</h1>
      <p data-aos="fade-right">Halo <?= $_SESSION["username"]?></p>
    </div>
    <nav>
      <a href="#">About</a>
      <a href="#N">Now Showing</a>
      <a href="#Upcoming">Upcoming</a>
      <a href="#">Contact</a>
      <a href="">Pesanan Saya</a>
      <form action="Web.php" method="post">
        <button class="logout" type="submit" name="logout">Logout</button>
      </form>
    </nav>
  </header>

  <section class="hero">
    <h2>Pesan Tiket Bioskop Cepat & Mudah</h2>
    <p>Nikmati pengalaman nonton terbaik bersama LuminaTIX</p>
    <button data-aos="fade-up">Pesan Sekarang</button>
  </section>

  <section id="N">
    <h2 style="text-align: center;" data-aos="fade-up">Now Showing</h2>
    <div class="movie-slider" data-aos="fade-up"
      data-aos-anchor-placement="top-center">
      <div class="movie-card">
        <img src="kimetsu no yaiba.webp" alt="kimetsu No Yaiba Infinity Castle">
        <h3>Kimetsu No Yaiba Infinity Castle</h3>
        <form action="KNY.html" method="get">
          <button type="submit">Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="Komang.jpg" alt="Komang">
        <h3>Komang (2025)</h3>
        <form action="Komang.html" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="chainsaw man reze arc.jpg" alt="Chainswaw Man-The Movie: Reze Arc (2025)">
        <h3>Chainswaw Man-The Movie: Reze Arc (2025)</h3>
        <form action="Chainsaw man.html" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="Agak Laen.jpeg" alt="Film 4">
        <h3>Agak Laen (2024) Horror Comedy</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="film-catatan-harian-menantu-sintingfoto-instagramcomcatatanharianmenantusinting.jpeg" alt="Film 5">
        <h3> Catatan Harian Menantu Sinting</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 6">
        <h3>Film 6</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 7">
        <h3>Film 7</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 8">
        <h3>Film 8</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 9">
        <h3>Film 9</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 10">
        <h3>Film 10</h3>
        <form action="" method="get">
          <button>Pesan</button>
        </form>

  </section>

  <section id="Upcoming" data-aos="fade-up">
    <h2 style="text-align: center;">Upcoming Movies</h2>
    <div class="movie-slider">
      <div class="movie-card" data-aos-anchor-placement="fade-down">
        <img src="" alt="Film 5">
        <h3>Film 5</h3>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 6">
        <h3>Film 6</h3>
      </div>
      <div class="movie-card">
        <img src="" alt="Film 7">
        <h3>Film 7</h3>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 LuminaTIX. All rights reserved.</p>
  </footer>

  <script>
    AOS.init({
      once: true,
      duration: 1800,
    });
    // Smooth scroll ke section
    document.querySelectorAll('nav a').forEach(link => {
      link.addEventListener('click', e => {
        const targetId = link.getAttribute('href');
        if (targetId.startsWith('#')) {
          e.preventDefault();
          document.querySelector(targetId).scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });

    // Tombol "Pesan Sekarang" scroll ke Now Showing
    const btnHero = document.querySelector('.hero button');
    btnHero.addEventListener('click', () => {
      document.querySelector('#N').scrollIntoView({
        behavior: 'smooth'
      });
    });

    // Efek hover dinamis di kartu film
    document.querySelectorAll('.movie-card').forEach(card => {
      card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.05)';
        card.style.transition = 'transform 0.3s ease';
        card.style.boxShadow = '0 6px 15px rgba(0,0,0,0.2)';
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
        card.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
      });
    });
  </script>
</body>

</html>