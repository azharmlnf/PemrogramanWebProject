<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $kamera_id = $_POST['kamera_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $keterangan = $_POST['keterangan'];

    // keterangan berisi type enum
    $allowed_values = ['dipinjam', 'dikembalikan'];
    if (!in_array($keterangan, $allowed_values)) {
        die("Invalid value for 'keterangan'");
    }

    $stmt = $mysqli->prepare("UPDATE peminjaman SET kamera_id=?, anggota_id=?, tanggal_peminjaman=?, tanggal_kembali=?, keterangan=? WHERE peminjaman_id=?");
    $stmt->bind_param("sssssi", $kamera_id, $anggota_id, $tanggal_peminjaman, $tanggal_kembali, $keterangan, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: peminjaman.php");
}

$sql = "SELECT * FROM peminjaman WHERE peminjaman_id='$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Peminjaman</title>
            <link rel="stylesheet" href="style.css">

</head>
<body>
    <a href="peminjaman.php">Kembali</a>
    <form action="updatepeminjaman.php?id=<?php echo $id; ?>" method="POST">
        Kamera id: <input type="text" name="kamera_id" value="<?php echo $row['kamera_id']; ?>"><br>
        Anggota id: <input type="text" name="anggota_id" value="<?php echo $row['anggota_id']; ?>"><br>
        Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" value="<?php echo $row['tanggal_peminjaman']; ?>"><br>
        Tanggal kembali: <input type="date" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>"><br>
        keterangan: 
        <select name="keterangan">
            <option value="dipinjam" <?php if ($row['keterangan'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
            <option value="dikembalikan" <?php if ($row['keterangan'] == 'dikembalikan') echo 'selected'; ?>>dikembalikan</option>
        </select><br>

        <input type="hidden" name="id" value="<?php echo $row['peminjaman_id']; ?>">
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
} else {
    echo "Data tidak ditemukan.";
}

$mysqli->close();
?>
