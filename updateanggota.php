<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    // Update data using prepared statement
    $stmt = $mysqli->prepare("UPDATE anggota SET nama=?, alamat=?, email=?, telepon=? WHERE anggota_id=?");
    $stmt->bind_param("ssssi", $nama, $alamat, $email, $telepon, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: anggota.php");
}

$sql = "SELECT * FROM anggota WHERE anggota_id='$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data Anggota</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
    <a href="anggota.php">Kembali</a>

        <form action="updateanggota.php?id=<?php echo $id; ?>" method="POST">
            Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
            Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
            Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
            Telepon: <input type="text" name="telepon" value="<?php echo $row['telepon']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['anggota_id']; ?>">
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
