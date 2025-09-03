<?php
session_start();

// A simple user authentication
$users = [
    'admin' => 'password123',
    'user' => 'password456'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username] == $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
    } else {
        header("Location: index.php?error=1");
    }
}
?>
