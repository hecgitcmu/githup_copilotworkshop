<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomId = $_POST['room_id'];
    $bookingDate = $_POST['booking_date'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $username = $_SESSION['username'];

    $data = json_decode(file_get_contents('database.json'), true);

    // Check for booking conflicts
    $conflict = false;
    foreach ($data['bookings'] as $booking) {
        if ($booking['room_id'] == $roomId && $booking['booking_date'] == $bookingDate) {
            if (($startTime < $booking['end_time']) && ($endTime > $booking['start_time'])) {
                $conflict = true;
                break;
            }
        }
    }

    if ($conflict) {
        header("Location: booking.php?error=conflict");
    } else {
        $newBooking = [
            'booking_id' => count($data['bookings']) + 1,
            'room_id' => $roomId,
            'username' => $username,
            'booking_date' => $bookingDate,
            'start_time' => $startTime,
            'end_time' => $endTime
        ];
        $data['bookings'][] = $newBooking;
        file_put_contents('database.json', json_encode($data, JSON_PRETTY_PRINT));
        header("Location: view_bookings.php");
    }
}
?>
