<?php
include("servis/database.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    die("<h3 style='color:red;text-align:center;margin-top:50px;'>Error: Anda harus login terlebih dahulu!</h3>");
}

$user_id = $_SESSION['user_id'];

if (!empty($_POST['seats']) && !empty($_POST['movie']) && !empty($_POST['schedule']) && !empty($_POST['date'])) {
    $seats = $_POST['seats'];
    $movie = mysqli_real_escape_string($db, $_POST['movie']);
    $schedule = mysqli_real_escape_string($db, $_POST['schedule']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $success = 0;

    foreach ($seats as $seat) {
        $seat = mysqli_real_escape_string($db, $seat);

        $query = "INSERT INTO bookings (seat, movie, schedule, date, user_id)
                  VALUES ('$seat', '$movie', '$schedule', '$date', '$user_id')";

        if (mysqli_query($db, $query)) {
            $success++;
        }
    }

        $_SESSION['success_message'] = "Berhasil memesan $success kursi untuk film <b>$movie</b> pada jam <b>$schedule</b> tanggal <b>$date</b>.";
    header("Location: success.php");
    exit;

} else {
    echo "<h3 style='color:red;text-align:center;margin-top:50px;'>
        Error: Kursi, film, jadwal, atau tanggal belum dikirim!
    </h3>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: black;
        }
    </style>
</head>
<body>
    
</body>
</html>