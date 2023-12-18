<?php
include 'header.php';
?>

<a href="index.php">Kembali</a><br>
<link rel="stylesheet" href="style.css">


<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

// Gabungkan tabel kamera dan peminjaman
$sql = "SELECT peminjaman.*, kamera.harga_sewa
        FROM peminjaman
        INNER JOIN kamera ON peminjaman.kamera_id = kamera.kamera_id";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>Peminjaman ID</th>
    <th>Kamera ID</th>
    <th>Anggota ID</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Kembali</th>
    <th>Durasi</th>
    <th>Total Sewa</th>
    <th>keterangan</th>
    <th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        // Hitung Durasi(tanggal_kembali-tanggal_peminjaman)
        $tanggal_peminjaman = new DateTime($row["tanggal_peminjaman"]);
        $tanggal_kembali = new DateTime($row["tanggal_kembali"]);
        $durasi = $tanggal_peminjaman->diff($tanggal_kembali)->format("%a");

        // Hitung Total Sewa(durasi * harga_sewa)
        $total_sewa = $durasi * $row["harga_sewa"];

        // Update data pada tabel peminjaman
        $updateSql = "UPDATE peminjaman SET durasi = $durasi, total_sewa = $total_sewa WHERE peminjaman_id = " . $row["peminjaman_id"];
        $mysqli->query($updateSql);

        // Tampilkan Tanggal Kembali, Durasi, dan Total Sewa
        echo "<tr>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["kamera_id"]."</td>";
        echo "<td>".$row["anggota_id"]."</td>";
        echo "<td>".$row["tanggal_peminjaman"]."</td>";
        echo "<td>".$row["tanggal_kembali"]."</td>";
        echo "<td>".$durasi." hari</td>";
        echo "<td>Rp. ".$total_sewa."</td>";
        echo "<td>".$row["keterangan"]."</td>";
        echo "<td><a href='updatepeminjaman.php?id=".$row["peminjaman_id"]."'>Edit</a> |
              <a href='deletepeminjaman.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data peminjaman kamera.";
}

$mysqli->close();
?><br>
<a href="tambahpeminjaman.php">Tambah Peminjaman</a> <br>
<a href="detail.php">Details</a><br>
<?php
include 'footer.php';
?>