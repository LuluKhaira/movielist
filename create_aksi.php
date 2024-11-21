<?php
// menghubungkan file yang berisi koneksi ke database
include('connect.php');

// Mengambil data yang dikirim melalui metode POST dari form
$j = ucfirst(trim($_POST['judul_film'])); // ucfirst = mengubah huruf pertama menjadi kapital
$g = ucfirst(trim($_POST['genre'])); 
$t = ucfirst(trim($_POST['tahun_terbit'])); 
$p = ucfirst(trim($_POST['penulis'])); 

// Melakukan query untuk memasukkan data ke dalam tabel 'movielist' di database
// mysql_query = untuk menjalankan query SQL terhadap database yang telah terkoneksi melalui MySQLi
mysqli_query($conn, "insert into movielist values ('', '$j', '$g', '$t', '$p')");
// '' Id - ID dibiarkan kosong, diasumsikan auto-increment diatur pada tabel 'movielist'

// Mengarahkan pengguna kembali ke halaman 'homepage.php' setelah data berhasil disimpan
// header = mengarahkan ke halaman lain
header("location:homepage.php"); 
?>
