<?php
include 'header.php';
?>
<a href="index.php">Kembali</a><br>
<a href='tambahpeminjaman.php'>Pinjam Kamera</a> <br>
<link rel="stylesheet" href="style.css">


<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

$sql = "SELECT * FROM kamera";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Merk</th>
    <th>Tahun Rilis</th>
    <th>Kategori ID</th>
    <th>Harga Sewa</th>
    <th>Gambar</th>
    <th>Action</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["kamera_id"]."</td>";
        echo "<td>".$row["nama"]."</td>";
        echo "<td>".$row["merk"]."</td>";
        echo "<td>".$row["tahun_rilis"]."</td>";
        echo "<td>".$row["kategori_id"]."</td>";
        echo "<td>Rp.".$row["harga_sewa"]."</td>";
        echo "<td><img src='images/".$row["gambar_kamera"]."' alt='' style='max-width: 200px; max-height: 150px;'></td>";
        echo "<td><a href='updatekamera.php?id=".$row["kamera_id"]."'>Edit</a> |
              <a href='deletekamera.php?id=".$row["kamera_id"]."'>Hapus</a> 
              </td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data kamera.";
}
$mysqli->close();
?><br>

<a href="tambahkamera.php">Tambah</a>

<?php
include 'footer.php';
?>