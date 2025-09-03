<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$data = json_decode(file_get_contents('database.json'), true);
$bookings = $data['bookings'];
$rooms = array_column($data['rooms'], 'name', 'id');

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .booking-table {
            color: white;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .booking-table th, .booking-table td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }
        .booking-table th {
            background-color: #03e9f4;
            color: #141e30;
        }
    </style>
</head>
<body>
    <div class="login-box" style="width: 800px;">
        <h2>Current Bookings</h2>
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Booked By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bookings)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No bookings yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rooms[$booking['room_id']]); ?></td>
                            <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['start_time']); ?></td>
                            <td><?php echo htmlspecialchars($booking['end_time']); ?></td>
                            <td><?php echo htmlspecialchars($booking['username']); ?></td>
                            <td>
                                <?php if ($booking['username'] == $_SESSION['username'] || $_SESSION['username'] == 'admin'): ?>
                                    <a href="cancel_booking.php?id=<?php echo $booking['booking_id']; ?>" style="color: #ff4b5c;">Cancel</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="welcome.php" style="text-align:center; display:block; margin-top: 20px;">
            Back to Welcome
        </a>
    </div>
</body>
</html>
