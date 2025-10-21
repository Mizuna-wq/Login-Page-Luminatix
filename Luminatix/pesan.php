<?php
include("servis/database.php");

$movie = $_GET['movie'] ?? '';
$date = $_GET['date'] ?? '';
$schedule = $_GET['schedule'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Bioskop</title>
    <style>
        body {
            background: #111;
            color: #facc15;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .screen {
            background-color: #facc15;
            height: 20px;
            width: 65%;
            margin: 20px auto;
            border-radius: 5px;
        }

        .seats {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 10px;
            justify-content: center;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
        }

        .seat {
            background-color: #333;
            border: 2px solid #facc15;
            height: 40px;
            border-radius: 6px;
            cursor: pointer;
            color: #facc15;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seat.booked {
            background-color: #444;
            color: #666;
            border-color: #555;
            cursor: not-allowed;
        }

        .seat.selected {
            background-color: #fff704ff;
        }

        .seat input {
            display: none;
        }

        button {
            background-color: #facc15;
            color: #111;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #bb9a16ff;
        }

        select,
        input[type="date"] {
            padding: 5px 10px;
            border-radius: 6px;
            border: none;
            font-size: 14px;
        }

        .date-schedule {
            display: inline-block;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background: #111;
            padding: 15px 20px;
            border-radius: 12px;
            box-shadow: 0 0 8px rgba(255, 204, 0, 0.2);
            width: fit-content;
            margin: 20px auto;
        }

        .date-schedule label {
            color: #ffcc00;
            font-weight: bold;
            font-size: 15px;
        }

        .date-schedule input[type="date"],
        .date-schedule select {
            background: #222;
            color: #fff;
            border: 1px solid #ffcc00;
            border-radius: 8px;
            padding: 6px 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        .date-schedule input[type="date"]:focus,
        .date-schedule select:focus {
            border-color: #ffd633;
            box-shadow: 0 0 6px #ffcc00;
        }

        .date-schedule select {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>Pilih Kursi Untuk Film <?php echo htmlspecialchars($movie); ?></h1>


    <form method="GET" action="">
        <input type="hidden" name="movie" value="<?php echo htmlspecialchars($movie); ?>">

        <div class="date-schedule">
            <label for="date">Tanggal:</label>
            <input type="date" name="date" id="date" required value="<?php echo htmlspecialchars($date); ?>">

            <label for="schedule">Jadwal:</label>
            <select name="schedule" id="schedule" required>
                <option value="">-- Pilih Jam --</option>
                <option value="13:00" <?php if ($schedule == '13:00') echo 'selected'; ?>>13:00</option>
                <option value="16:00" <?php if ($schedule == '16:00') echo 'selected'; ?>>16:00</option>
                <option value="19:00" <?php if ($schedule == '19:00') echo 'selected'; ?>>19:00</option>
            </select>
        </div>
        <button type="submit">Lihat Kursi</button>
    </form>

    <?php if ($schedule && $date): ?>
        <div class="screen"></div>

        <form action="process_booking.php" method="POST">
            <input type="hidden" name="movie" value="<?php echo htmlspecialchars($movie); ?>">
            <input type="hidden" name="schedule" value="<?php echo htmlspecialchars($schedule); ?>">
            <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">

            <div class="seats">
                <?php
                $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                $cols = 8;

                $movieEsc = mysqli_real_escape_string($db, $movie);
                $scheduleEsc = mysqli_real_escape_string($db, $schedule);
                $dateEsc = mysqli_real_escape_string($db, $date);

                $result = mysqli_query($db, "
                    SELECT seat FROM bookings 
                    WHERE movie='$movieEsc' 
                    AND schedule='$scheduleEsc' 
                    AND date='$dateEsc'
                ");
                $booked = [];
                if (!$result) die('Query error: ' . mysqli_error($db));

                while ($row = mysqli_fetch_assoc($result)) {
                    $booked[] = $row['seat'];
                }

                foreach ($rows as $r) {
                    for ($i = 1; $i <= $cols; $i++) {
                        $seat = $r . $i;
                        $isBooked = in_array($seat, $booked);
                        $class = $isBooked ? "seat booked" : "seat";
                        $disabled = $isBooked ? "disabled" : "";
                        echo "<div class='$class'>
                            <input type='checkbox' name='seats[]' value='$seat' $disabled>
                            $seat
                        </div>";
                    }
                }
                ?>
            </div>

            <button type="submit">Pesan Sekarang</button>
        </form>

        <script>
            document.querySelectorAll('.seat:not(.booked)').forEach(seat => {
                seat.addEventListener('click', () => {
                    seat.classList.toggle('selected');
                    const checkbox = seat.querySelector('input');
                    checkbox.checked = !checkbox.checked;
                });
            });
        </script>
    <?php endif; ?>

</body>

</html>