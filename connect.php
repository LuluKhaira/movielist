<?php

$servername = "localhost";  // Menentukan bahwa server database berada pada server lokal.
$username = "root";  //Nama pengguna yang digunakan untuk mengakses database.
$password = ""; //Kata sandi pengguna untuk mengakses database
$dbname = "movielist";   //nama database yang akan diakses, yaitu "login"
$conn = new mysqli($servername, $username, $password, $dbname);
//Kode ini memeriksa apakah koneksi ke database berhasil atau gagal
if ($conn->connect_error) {
    echo "Failed to connect DB" . $conn->connect_error;
}

?>