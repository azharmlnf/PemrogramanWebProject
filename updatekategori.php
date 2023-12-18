<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $kategori_id = $_POST['id']; // Ambil nilai kategori_id dari formulir

    // Perbarui query untuk UPDATE
    $stmt = $mysqli->prepare("UPDATE kategori SET nama_kategori=? WHERE kategori_id=?");
    $stmt->bind_param("si", $nama_kategori, $kategori_id);
    $stmt->execute();
    $stmt->close();

    header("Location: kategori.php");
}

$sql = "SELECT * FROM kategori WHERE kategori_id='$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="kategori.php">Kembali</a>
    <form action="updatekategori.php?id=<?php echo $id; ?>" method="POST">

        Nama Kategori: <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>"><br>

        <input type="hidden" name="id" value="<?php echo $row['kategori_id']; ?>">
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
