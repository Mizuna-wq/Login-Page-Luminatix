<?php
include("servis/database.php");
session_name("admin_session");
session_start();

if (isset($_POST["logout"])) {
    session_unset();
    header("location: loginAdmin.php");
}

if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $aksi = $_GET['aksi'];

    if ($aksi == 'verifikasi') {
        mysqli_query($db, "UPDATE bookings SET status_pembayaran='Lunas' WHERE id='$id'");
        echo "<script>alert('Pembayaran ID #$id telah diverifikasi.'); window.location='admin.php';</script>";
        exit;
    } elseif ($aksi == 'tolak') {
        mysqli_query($db, "UPDATE bookings SET status_pembayaran='Pembayaran Ditolak' WHERE id='$id'");
        echo "<script>alert('Pembayaran ID #$id telah ditolak.'); window.location='admin.php';</script>";
        exit;
    }
}

$result = mysqli_query($db, "SELECT b.*, u.username FROM bookings b JOIN users u ON b.user_id = u.id ORDER BY b.id DESC");
if (!$result) {
    die("<h3 style='color:red;text-align:center;margin-top:50px;'>Query Error: " . mysqli_error($db) . "</h3>");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Kelola Pembayaran - Admin</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #0d0d0d;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #ffd700;
            margin-top: 30px;
            letter-spacing: 1px;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: #1a1a1a;
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border-bottom: 1px solid #333;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #222;
            color: #ffd700;
        }

        tr:hover {
            background-color: #111;
        }

        .btn {
            padding: 7px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-verif {
            background: linear-gradient(90deg, #ffd700, #bfa200);
            color: #000;
        }

        .btn-tolak {
            background: #c0392b;
            color: #fff;
        }

        .btn-lihat {
            background: #2980b9;
            color: #fff;
        }

        .btn-verif:hover {
            background: linear-gradient(90deg, #ffdb4d, #d4af37);
        }

        .btn-tolak:hover {
            background: #e74c3c;
        }

        .btn-lihat:hover {
            background: #3498db;
        }

        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .menunggu {
            color: #ffd700;
        }

        .lunas {
            color: #2ecc71;
        }

        .ditolak {
            color: #e74c3c;
        }

        .back {
            text-align: center;
            margin: 25px;
        }

        a.home {
            color: #ffd700;
            text-decoration: none;
            font-weight: bold;
        }

        a.home:hover {
            color: #fff;
        }

        button [name='logout'] {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            align-items: center;
            justify-content: center;
        }

        .btn-logout {

            background: linear-gradient(90deg, #e74c3c, #c0392b);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            font-family: 'Poppins', Arial, sans-serif;

        }

        .btn-logout:hover {
            background: linear-gradient(90deg, #ff5c5c, #e74c3c);
            transform: translateY(-1px);
        }

        form {
            position: absolute;
            top: 20px;
            right: 30px;
        }
    </style>
</head>

<body>
    <h2>🧾 Kelola Pembayaran Pengguna</h2>

    <table>
        <tr>
            <th>Harga</th>
            <th>ID</th>
            <th>Username</th>
            <th>Film</th>
            <th>Jadwal</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>Rp<?= htmlspecialchars($row['harga']) ?></td>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['movie']) ?></td>
                <td><?= htmlspecialchars($row['schedule']) ?></td>
                <td>
                    <?php if (!empty($row['bukti_transfer'])) { ?>
                        <a class="btn btn-lihat" href="uploads/<?= htmlspecialchars($row['bukti_transfer']) ?>" target="uploads/">Lihat</a>
                    <?php } else { ?>
                        <i>Tidak ada bukti</i>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $status = $row['status_pembayaran'] ?? 'Menunggu Verifikasi';
                    $class = $status == 'Lunas' ? 'lunas' : ($status == 'Pembayaran Ditolak' ? 'pembayaran ditolak' : 'menunggu verifikasi');
                    ?>
                    <span class="status <?= $class ?>"><?= htmlspecialchars($status) ?></span>
                </td>
                <td>
                    <a class="btn btn-verif" href="admin.php?aksi=verifikasi&id=<?= $row['id'] ?>">Verifikasi</a>
                    <a class="btn btn-tolak" href="admin.php?aksi=tolak&id=<?= $row['id'] ?>">Tolak</a>
                <?php } ?>
                </td>
            </tr>
    </table>

    <div class="back">
        <a class="home" href="index.php">⬅ Kembali ke Beranda</a>
    </div>
    <form method="post">
        <button type="submit" name="logout" class="btn-logout">Logout</button>
    </form>
</body>

</html>