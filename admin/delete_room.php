<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: welcome.php");
    exit;
}

if (isset($_GET['id'])) {
    $roomId = $_GET['id'];

    $data = json_decode(file_get_contents('database.json'), true);

    // Filter out the room to be deleted
    $data['rooms'] = array_filter($data['rooms'], function($room) use ($roomId) {
        return $room['id'] != $roomId;
    });

    // Also delete bookings associated with the room
    $data['bookings'] = array_filter($data['bookings'], function($booking) use ($roomId) {
        return $booking['room_id'] != $roomId;
    });

    file_put_contents('database.json', json_encode($data, JSON_PRETTY_PRINT));
    header("Location: admin_rooms.php");
}
?>
