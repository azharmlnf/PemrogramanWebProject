<?php
include 'header.php';
?>
<?php
include 'koneksi.php';
session_start();

// Login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Selamat Datang di admin Panel pemesanan Kamera
</h1>
</body>
</html>


<?php
include 'footer.php';
?>