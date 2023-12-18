<?php
include 'koneksi.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];


    $stmt = $mysqli->prepare("UPDATE pengembalian SET tanggal_pengembalian=? WHERE pengembalian_id=?");
    $stmt->bind_param("si", $tanggal_pengembalian, $id);
    $stmt->execute();
    $stmt->close();
    

    header("Location: pengembalian.php");
}

$sql = "SELECT * FROM pengembalian WHERE pengembalian_id='$id'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data pengembalian</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <a href="pengembalian.php">kembali</a>
    <form action="updatepengembalian.php?id=<?php echo $id; ?>" method="POST">
        tanggal_pengembalian: <input type="date" name="tanggal_pengembalian" value="<?php echo $row['tanggal_pengembalian']; ?>"><br>

        <input type="hidden" name="id" value="<?php echo $row['pengembalian_id']; ?>">
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
