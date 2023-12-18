<?php
$host = '127.0.0.1:3307';
$username = 'root';
$password = '';
$dbname = 'databasekamera';
$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
   die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
