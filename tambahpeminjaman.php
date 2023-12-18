<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kamera_id = $_POST['kamera_id'];
    $anggota_id = $_POST['anggota_id'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $sql = "INSERT INTO peminjaman (kamera_id, anggota_id, tanggal_peminjaman, tanggal_kembali ) 
            VALUES ('$kamera_id', '$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: peminjaman.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}
?>
<a href="peminjaman.php">Kembali</a>
<form action="tambahpeminjaman.php" method="POST">
    Kamera ID: 
    <select name="kamera_id" required>
        <?php
        $queryKamera = "SELECT kamera_id, nama FROM kamera";
        $resultKamera = $mysqli->query($queryKamera);

        if ($resultKamera->num_rows > 0) {
            while ($rowKamera = $resultKamera->fetch_assoc()) {
                echo "<option value='" . $rowKamera['kamera_id'] . "'>" . $rowKamera['nama'] . "</option>";
            }
        }
        ?>
    </select><br>
    Anggota ID: <input type="text" name="anggota_id" required><br>
    Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" required><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali" required><br>

    <input type="submit" value="Tambah">
</form>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>
