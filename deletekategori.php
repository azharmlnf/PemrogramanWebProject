<?php
include 'koneksi.php';
$id = $_GET['id']; // ID dari kamera yang akan dihapus
$sql = "DELETE FROM kategori WHERE kategori_id=$id";
if ($mysqli->query($sql) === TRUE) {
 header("Location: kategori.php"); // Redirect ke tampilan Read setelah berhasil hapus data
 exit;
} else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();
?>