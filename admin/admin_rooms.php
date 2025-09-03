<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: welcome.php");
    exit;
}

$data = json_decode(file_get_contents('database.json'), true);
$rooms = $data['rooms'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Rooms</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .room-table {
            color: white;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .room-table th, .room-table td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }
        .room-table th {
            background-color: #03e9f4;
            color: #141e30;
        }
        .delete-btn {
            color: #ff4b5c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-box" style="width: 800px;">
        <h2>Manage Meeting Rooms</h2>
        <table class="room-table">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room['name']); ?></td>
                        <td><a href="delete_room.php?id=<?php echo $room['id']; ?>" class="delete-btn">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 style="color: white; margin-top: 40px;">Add New Room</h3>
        <form action="add_room.php" method="post">
            <div class="user-box">
                <input type="text" name="room_name" required="">
                <label>Room Name</label>
            </div>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="Add Room" style="background:none; border:none; color:white; font-size:16px; cursor:pointer; padding: 10px 20px;">
            </a>
        </form>

        <a href="welcome.php" style="text-align:center; display:block; margin-top: 20px;">
            Back to Welcome
        </a>
    </div>
</body>
</html>
