<?php
include 'header.php';
?>
<a href="index.php">Kembali</a>
<link rel="stylesheet" href="style.css">

<?php
include 'koneksi.php';
session_start();
if (!$_SESSION['username']){
    header('location: login.php');
    exit();
}

//gabungkan tabel peminjaman dan pengembalian
$sql = "SELECT pengembalian.*, peminjaman.tanggal_kembali
        FROM pengembalian
        INNER JOIN peminjaman ON pengembalian.peminjaman_id = peminjaman.peminjaman_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
    <th>Pengembalian ID</th>
    <th>Peminjaman ID</th>
    <th>Tanggal Pengembalian</th> 
    <th>Keterlambatan</th>
    <th>Denda (Rp.50.000 /hari)</th>  
    <th>Status Pengembalian</th> 
    <th>Action</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["pengembalian_id"]."</td>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["tanggal_pengembalian"]."</td>";

        // Hitung Terlambat
        $tanggal_kembali = new DateTime($row["tanggal_kembali"]);
        $tanggal_pengembalian = new DateTime($row["tanggal_pengembalian"]);
        $terlambat = $tanggal_kembali->diff($tanggal_pengembalian)->format("%a");

        // Hitung Denda
        $denda = $terlambat > 0 ? $terlambat * 50000 : 0;

        // Tampilkan Terlambat
        echo "<td>".$terlambat." Hari</td>";

        // Tampilkan Denda
        echo "<td>Rp.".$denda."</td>";

        // Tampilkan Status Pengembalian
        if($terlambat > 0 ){
            echo'<td>Terlambat</td>';
        } else {
            echo "<td>Dikembalikan</td>";
        }

        // Tampilkan Action
        echo "<td><a href='updatepengembalian.php?id=".$row["pengembalian_id"]."'>Edit</a> </td>";
        echo "</tr>";

        // Update denda ke dalam tabel pengembalian
        $update_denda_sql = "UPDATE pengembalian SET denda = '$denda' WHERE pengembalian_id = ".$row["pengembalian_id"];
        $mysqli->query($update_denda_sql);
    }

    echo "</table>";
} else {
    echo "Tidak ada data pengembalian.";
}

$mysqli->close();
?><br>

<a href="tambahpengembalian.php">Kembalikan Kamera</a> <br>

<?php
include 'footer.php';
?>