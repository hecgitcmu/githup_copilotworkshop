<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-box">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p style="color:white; text-align:center;">You have successfully logged in.</p>
        <a href="booking.php" style="text-align:center; display:block;">
            Book a Room
        </a>
        <a href="view_bookings.php" style="text-align:center; display:block; margin-top: 20px;">
            View Bookings
        </a>
        <?php if ($_SESSION['username'] == 'admin'): ?>
        <a href="admin_rooms.php" style="text-align:center; display:block; margin-top: 20px;">
            Manage Rooms
        </a>
        <?php endif; ?>
        <a href="logout.php" style="text-align:center; display:block; margin-top: 20px;">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Logout
        </a>
    </div>
</body>
</html>
