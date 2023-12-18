<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nama_kategori= $_POST['nama_kategori'];
 $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
 
 if ($mysqli->query($sql) === TRUE) {
 header("Location: kategori.php"); // lokasi ke tampilan Read setelah berhasil tambah data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<a href="kategori.php">Kembali</a>
<form action="tambahkategori.php" method="POST">
 Nama Kategori: <input type="text" name="nama_kategori"required><br>
 
 <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah kategori Kamera</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>