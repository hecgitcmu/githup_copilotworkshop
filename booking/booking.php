<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$data = json_decode(file_get_contents('database.json'), true);
$rooms = $data['rooms'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Room</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-box">
        <h2>Book a Meeting Room</h2>
        <form action="book.php" method="post">
            <div class="user-box">
                <select name="room_id" required="" style="width: 100%; background: transparent; color: white; border: none; border-bottom: 1px solid #fff; padding: 10px 0; font-size: 16px; margin-bottom: 20px;">
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?php echo $room['id']; ?>" style="background: #243b55;"><?php echo htmlspecialchars($room['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="user-box">
                <input type="date" name="booking_date" required="" style="color-scheme: dark;">
                <label>Date</label>
            </div>
            <div class="user-box">
                <input type="time" name="start_time" required="" style="color-scheme: dark;">
                <label>Start Time</label>
            </div>
            <div class="user-box">
                <input type="time" name="end_time" required="" style="color-scheme: dark;">
                <label>End Time</label>
            </div>
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" value="Book Now" style="background:none; border:none; color:white; font-size:16px; cursor:pointer; padding: 10px 20px;">
            </a>
        </form>
        <a href="welcome.php" style="text-align:center; display:block; margin-top: 20px;">
            Back to Welcome
        </a>
    </div>
</body>
</html>
