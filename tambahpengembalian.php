<?php
include 'koneksi.php';

// Query untuk mendapatkan peminjaman_id yang memiliki keterangan 'dipinjam'
$query_peminjaman = "SELECT peminjaman_id FROM peminjaman WHERE keterangan = 'dipinjam'";
$result_peminjaman = $mysqli->query($query_peminjaman);

// Mengumpulkan peminjaman_id ke dalam array
$peminjaman_ids = [];
while ($row = $result_peminjaman->fetch_assoc()) {
    $peminjaman_ids[] = $row['peminjaman_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peminjaman_id = $_POST['peminjaman_id'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];

    // Menentukan apakah pengembalian terlambat atau dikembalikan
    $today = date('Y-m-d');
    $terlambat = (strtotime($tanggal_pengembalian) - strtotime($today)) > 0;
    $status_pengembalian = $terlambat ? 'terlambat' : 'dikembalikan';

    $sql_pengembalian = "INSERT INTO pengembalian (peminjaman_id, tanggal_pengembalian, status_pengembalian) VALUES ('$peminjaman_id', '$tanggal_pengembalian', '$status_pengembalian')";

    if ($mysqli->query($sql_pengembalian) === TRUE) {
        // Update keterangan pada tabel peminjaman menjadi 'dikembalikan'
        $sql_peminjaman = "UPDATE peminjaman SET keterangan = 'dikembalikan' WHERE peminjaman_id = '$peminjaman_id'";
        $mysqli->query($sql_peminjaman);

        header("Location: pengembalian.php");
        exit;
    } else {
        echo "Error: " . $sql_pengembalian . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>

<a href="pengembalian.php">Kembali</a>
<form action="tambahpengembalian.php" method="POST">
    Peminjaman ID:
    <select name="peminjaman_id">
        <?php
        // Menampilkan peminjaman_id sebagai pilihan dropdown
        foreach ($peminjaman_ids as $id) {
            echo "<option value='$id'>$id</option>";
        }
        ?>
    </select><br>
    Tanggal Pengembalian: <input type="date" name="tanggal_pengembalian" required><br>

    <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
