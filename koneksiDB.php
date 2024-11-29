<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "tugasPresensi27_11-24";

// Koneksi
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
  echo "Koneksi gagal: " . mysqli_connect_error();
} 
?>