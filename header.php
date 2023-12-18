<?php
// Check if the logout parameter is set
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {

    session_start();
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
    <title>Pemrograman Web</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        nav {
            background-color: #007bff;
            overflow: hidden;
        }

        nav a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin  Sewa Kamera</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="kamera.php">Data Kamera</a>
        <a href="anggota.php">Data Anggota</a>
        <a href="kategori.php">Data Kategori Kamera</a>
        <a href="peminjaman.php">Peminjaman Kamera</a>
        <a href="pengembalian.php">Pengembalian Kamera</a>
        <a href="detail.php">Detail Peminjaman dan Pengembalian</a>
        <a href="?logout=true">Logout</a>
    </nav>
    

</body>
</html>
