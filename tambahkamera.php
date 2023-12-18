<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nama = $_POST['nama'];
 $merk = $_POST['merk'];
 $tahun_rilis = $_POST['tahun_rilis'];
 $harga_sewa = $_POST['harga_sewa'];
 $kategori_id = $_POST['kategori_id'];
 $gambar_kamera = $_POST['gambar_kamera'];

 $sql = "INSERT INTO kamera (nama, merk, tahun_rilis, kategori_id, harga_sewa, gambar_kamera) VALUES ('$nama', '$merk', '$tahun_rilis', '$kategori_id', '$harga_sewa', '$gambar_kamera')";

 
 if ($mysqli->query($sql) === TRUE) {
 header("Location: kamera.php"); 
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<a href="kamera.php">Kembali</a>
<form action="tambahkamera.php" method="POST">
 Nama: <input type="text" name="nama"><br>
 Merk: <input type="text" name="merk"><br>
 tahun Rilis: <input type="text" name="tahun_rilis"><br>
 Kategori Id : <input type="text" name="kategori_id"><br>
 Harga sewa: <input type="text" name="harga_sewa"><br>

 Gambar: <input type="file" name="gambar_kamera"><br>

 <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamera</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>