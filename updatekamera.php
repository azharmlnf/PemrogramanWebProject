<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $merk = $_POST['merk'];
    $tahun_rilis = $_POST['tahun_rilis'];
    $kategori_id = $_POST['kategori_id'];
    $harga_sewa = $_POST['harga_sewa'];
    $gambar_kamera = $_POST['gambar_kamera'];

    $stmt = $mysqli->prepare("UPDATE kamera SET nama=?, merk=?, tahun_rilis=?, kategori_id=?, harga_sewa=?, gambar_kamera=? WHERE kamera_id=?");
    $stmt->bind_param("ssssisi", $nama, $merk, $tahun_rilis, $kategori_id, $harga_sewa , $gambar_kamera, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: kamera.php");
}

$sql = "SELECT * FROM kamera WHERE kamera_id='$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data kamera</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <a href="kamera.php">kembali</a>
    <form action="updatekamera.php?id=<?php echo $id; ?>" method="POST">
        nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
        merk: <input type="text" name="merk" value="<?php echo $row['merk']; ?>"><br>
        Tahun Rilis: <input type="text" name="tahun_rilis" value="<?php echo $row['tahun_rilis']; ?>"><br>
        Kategori ID: <input type="text" name="kategori_id" value="<?php echo $row['kategori_id']; ?>"><br>
        Harga Sewa: <input type="text" name="harga_sewa" value="<?php echo $row['harga_sewa']; ?>"><br>
        Gambar: <input type="file" name="gambar_kamera" value="<?php echo $row['gambar_kamera']; ?>"><br>

        <input type="hidden" name="id" value="<?php echo $row['kamera_id']; ?>">
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
