<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    $data = json_decode(file_get_contents('database.json'), true);

    $bookingToCancel = null;
    foreach ($data['bookings'] as $booking) {
        if ($booking['booking_id'] == $bookingId) {
            $bookingToCancel = $booking;
            break;
        }
    }

    // Check if the user is authorized to cancel this booking
    if ($bookingToCancel && ($bookingToCancel['username'] == $_SESSION['username'] || $_SESSION['username'] == 'admin')) {
        $data['bookings'] = array_filter($data['bookings'], function($booking) use ($bookingId) {
            return $booking['booking_id'] != $bookingId;
        });

        file_put_contents('database.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    header("Location: view_bookings.php");
}
?>
