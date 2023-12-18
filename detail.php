<?php
include 'header.php';
?>
<a href="index.php">Kembali</a>
<link rel="stylesheet" href="style.css">


<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']) {
    header('location: login.php');
    exit();
}

// Gabungkan tabel kamera, peminjaman, dan pengembalian dengan anggota
$sql = "SELECT peminjaman.*, kamera.*, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian, anggota.nama AS anggota_nama, anggota.alamat AS anggota_alamat, anggota.email AS anggota_email, anggota.telepon AS anggota_telepon
        FROM peminjaman
        INNER JOIN kamera ON peminjaman.kamera_id = kamera.kamera_id
        LEFT JOIN pengembalian ON peminjaman.peminjaman_id = pengembalian.peminjaman_id
        LEFT JOIN anggota ON peminjaman.anggota_id = anggota.anggota_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>Peminjaman ID</th>
    <th>Kamera ID</th>
    <th>Anggota ID</th>
    <th>Nama Anggota</th>
    <th>Alamat Anggota</th>
    <th>Email Anggota</th>
    <th>Nomor Telepon Anggota</th>
    <th>Tanggal Peminjaman</th>
    <th>Tanggal Kembali</th>
    <th>Durasi</th>
    <th>Total Sewa</th>
    <th>Kamera Nama</th>
    <th>Kamera Merk</th>
    <th>Kamera Tahun Rilis</th>
    <th>Harga Sewa</th>
    <th>Tanggal Pengembalian</th>
    <th>Terlambat</th>
    <th>Denda</th>
    <th>Status Pengembalian</th>
</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["kamera_id"]."</td>";
        echo "<td>".$row["anggota_id"]."</td>";
        echo "<td>".$row["anggota_nama"]."</td>";
        echo "<td>".$row["anggota_alamat"]."</td>";
        echo "<td>".$row["anggota_email"]."</td>";
        echo "<td>".$row["anggota_telepon"]."</td>";
        echo "<td>".$row["tanggal_peminjaman"]."</td>";

        // Hitung Durasi
        $tanggal_peminjaman = new DateTime($row["tanggal_peminjaman"]);
        $tanggal_kembali = new DateTime($row["tanggal_kembali"]);
        $durasi = $tanggal_peminjaman->diff($tanggal_kembali)->format("%a");

        // Hitung Total Sewa
        $total_sewa = $durasi * $row["harga_sewa"];

        // Tampilkan Tanggal Kembali, Durasi, dan Total Sewa
        echo "<td>".$row["tanggal_kembali"]."</td>";
        echo "<td>".$durasi." hari</td>";
        echo "<td>Rp. ".$total_sewa."</td>";

        // Informasi Kamera
        echo "<td>".$row["nama"]."</td>";
        echo "<td>".$row["merk"]."</td>";
        echo "<td>".$row["tahun_rilis"]."</td>";
        echo "<td>Rp. ".$row["harga_sewa"]."</td>";

        // Informasi Pengembalian
        echo "<td>".$row["tanggal_pengembalian"]."</td>";

        // Hitung Terlambat
        $tanggal_kembali = new DateTime($row["tanggal_kembali"]);
        $tanggal_pengembalian = new DateTime($row["tanggal_pengembalian"]);
        $terlambat = $tanggal_pengembalian->diff($tanggal_kembali)->format("%a");

        echo "<td>".$terlambat." Hari</td>";
        echo "<td>Rp. ".$row["denda"]."</td>";
        echo "<td>".$row["status_pengembalian"]."</td>";

         "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data peminjaman kamera.";
}

$mysqli->close();
?>

<?php
include 'footer.php';
?>
