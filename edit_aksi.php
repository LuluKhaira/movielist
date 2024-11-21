<?php
include('connect.php');

// Trim dan ubah huruf pertama menjadi huruf besar
$i = $_POST['id']; // Ambil nilai 'id' dari data yang dikirim melalui POST
$j = ucfirst(trim($_POST['judul_film'])); // ucfirst = mengubah huruf pertama menjadi kapital
$g = ucfirst(trim($_POST['genre'])); 
$t = ucfirst(trim($_POST['tahun_terbit'])); 
$p = ucfirst(trim($_POST['penulis'])); 

// Update data di tabel 'movielist' sesuai 'id'
mysqli_query($conn, "update movielist set judul_film='$j', genre='$g', tahun_terbit='$t', penulis='$p' where id='$i'");

// Redirect ke homepage setelah update selesai
header("location:homepage.php");
