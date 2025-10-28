<?php
include("servis/database.php");
session_name("user_session");
session_start();

if (!isset($_SESSION['username'])) {
    die("<h3 style='color:red;text-align:center;margin-top:50px;'>Silakan login dulu untuk melanjutkan ke checkout.</h3>");
}
//id dikirim lewat URL
$id = intval($_GET['id']); // paksa jadi angka biar aman
$query = mysqli_query($db, "SELECT * FROM bookings WHERE id=$id");


$id = $_GET['id'];
$query = mysqli_query($db, "SELECT * FROM bookings WHERE id='$id'");
if (mysqli_num_rows($query) == 0) {
    die("<h3 style='color:red;text-align:center;margin-top:50px;'>Data booking tidak ditemukan.</h3>");
}

// proses upload bukti transfer
if (isset($_POST['upload'])) {
    $file = $_FILES['bukti']['name'];
    $tmp = $_FILES['bukti']['tmp_name'];

    if (!empty($file)) {
        // simpan ke folder uploads
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir);

        // nama file 
        $newName = "bukti_" . $id . "_" . time() . "." . pathinfo($file, PATHINFO_EXTENSION);
        $targetPath = $uploadDir . $newName;

        if (move_uploaded_file($tmp, $targetPath)) {
            //  update kolom bukti di tabel bookings
            mysqli_query($db, "UPDATE bookings SET bukti_transfer='$newName', status_pembayaran='Menunggu Konfirmasi' WHERE id='$id'");

            echo "<script>
                    alert('Bukti pembayaran berhasil diunggah E-Ticket Akan Dikirim Melalui Email.');
                    window.location='Pesanan.php';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Gagal mengunggah bukti pembayaran.');</script>";
        }
    } else {
        echo "<script>alert('Silakan pilih file bukti transfer terlebih dahulu.');</script>";
    }
}
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout Pembayaran</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #0d0d0d;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 480px;
            margin: 70px auto;
            background: #1a1a1a;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.15);
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #ffd700;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }

        p {
            text-align: center;
            font-size: 15px;
            margin-bottom: 25px;
        }

        b {
            color: #ffd700;
        }

        label {
            color: #ffd700;
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        input[type="file"] {
            width: 100%;
            background: #111;
            border: 1px solid #333;
            color: #f5f5f5;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            background: #ffd700;
            color: #000;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background: #e6c200;
        }

        button {
            background: linear-gradient(90deg, #ffd700, #bfa200);
            color: #000;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(90deg, #ffdb4d, #d4af37);
            transform: translateY(-1px);
        }

        a {
            text-decoration: none;
            color: #ffd700;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #fff;
        }

        .back {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        /* animasi ringan */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            animation: fadeIn 0.6s ease-out;
        }

        a {
            padding: 5px 10px;
            background: gold;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            display: inline-block;

        }
        a:hover {
            background: #ffd700;
            transition: transform 0.5s;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>💳 Upload Bukti Pembayaran</h2>
        <p style="text-align:center;">ID Booking: <b><?= htmlspecialchars($id) ?></b></p>
        <p>Harga tiket: <b>Rp <?= number_format($row['harga'], 0, ",", ".") ?></b></p>
        <p>Kursi: <b><?= htmlspecialchars($row['seat']) ?></b></p>
        <form method="post" enctype="multipart/form-data">
            <label><b>Pilih Bukti Transfer (JPG/PNG)</b></label><br><br>
            <input type="file" name="bukti" accept=".jpg,.jpeg,.png" required><br><br>
            <button type="submit" name="upload">Upload Bukti</button>
        </form>
        <div class="back">
            <a href="pesanan.php" style="text-decoration:none;color: black;">Kembali</a>
        </div>
    </div>
</body>

</html>