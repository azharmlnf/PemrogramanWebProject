<?php

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_destroy();
    
    header('Location: login.php'); 
    exit();
}
?>
<link rel="stylesheet" href="style.css">

<body>
    <header class="header">
        <h1>Admin Sewa Kamera</h1>
    </header>
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="kamera.php">Data Kamera</a>
        <a href="anggota.php">Data Anggota</a>
        <a href="kategori.php">Data Kategori Kamera</a>
        <a href="peminjaman.php">Peminjaman Kamera</a>
        <a href="pengembalian.php">Pengembalian Kamera</a>
        <a href="detail.php">Detail Peminjaman dan Pengembalian</a>
        <a href="login.php">Logout</a> 
    </nav>
</body>
</html>
