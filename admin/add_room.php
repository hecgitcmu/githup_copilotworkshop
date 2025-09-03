<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: welcome.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['room_name'];

    $data = json_decode(file_get_contents('database.json'), true);

    $newRoom = [
        'id' => count($data['rooms']) > 0 ? max(array_column($data['rooms'], 'id')) + 1 : 1,
        'name' => $roomName
    ];

    $data['rooms'][] = $newRoom;
    file_put_contents('database.json', json_encode($data, JSON_PRETTY_PRINT));
    header("Location: admin_rooms.php");
}
?>
