<?php
include 'koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nama = $_POST['nama'];
 $alamat = $_POST['alamat'];
 $email = $_POST['email'];
 $telepon = $_POST['telepon'];
 $sql = "INSERT INTO anggota (nama, alamat, email, telepon) VALUES ('$nama', 
'$alamat', '$email', '$telepon')";
 
 if ($mysqli->query($sql) === TRUE) {
 header("Location: anggota.php"); // lokasi ke tampilan Read setelah berhasil tambah data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}
?>
<a href="anggota.php">Kembali</a>
<form action="tambahanggota.php" method="POST">
 nama: <input type="text" name="nama"><br>
 alamat: <input type="text" name="alamat"><br>
 email: <input type="text" name="email"><br>
 telepon: <input type="text" name="telepon"><br>
 <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
</body>
</html>