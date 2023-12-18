<?php
include 'header.php';
?>
<link rel="stylesheet" href="style.css">

<a href="index.php">kembali</a>
<?php //Data anggota 
include 'koneksi.php';
$sql = "SELECT * FROM anggota";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 echo "<table border='1'>";
 echo "<tr><th>Anggota_id</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Nomor
Telepon</th><th>Action</th></tr>";
 while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["anggota_id"]."</td>";
 echo "<td>".$row["nama"]."</td>";
 echo "<td>".$row["alamat"]."</td>";
 echo "<td>".$row["email"]."</td>";
 echo "<td>".$row["telepon"]."</td>";
 echo "<td><a href='updateanggota.php?id=".$row["anggota_id"]."'>Edit</a> | <a
href='deleteanggota.php?id=".$row["anggota_id"]."'>Hapus</a></td>";
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "Tidak ada data anggota.";
}
$mysqli->close();
?>
<a href="tambahanggota.php">Tambah</a>

<?php
include 'footer.php';
?>