<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $sql = "INSERT INTO kamera (nama, merk, tahun_rilis, kategori_id, harga_sewa, gambar_kamera) VALUES ('$nama', '$merk', '$tahun_rilis', '$kategori_id', '$harga_sewa', '$gambar_kamera')";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: kamera.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}


$queryKategori = "SELECT kategori_id, nama_kategori FROM kategori";
$resultKategori = $mysqli->query($queryKategori);

?>

<a href="kamera.php">Kembali</a>
<form class="form-container" action="tambahkamera.php" method="POST">
    Nama: <input type="text" name="nama" required><br>
    Merk: <input type="text" name="merk" required><br>
    Tahun Rilis: <input type="text" name="tahun_rilis" required><br>

    Kategori:
    <select name="kategori_id" required>
        <?php
        while ($rowKategori = $resultKategori->fetch_assoc()) {
            echo "<option value='" . $rowKategori['kategori_id'] . "'>" . $rowKategori['nama_kategori'] . "</option>";
        }
        ?>
    </select><br>

    Harga Sewa: <input type="text" name="harga_sewa" required><br>
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
