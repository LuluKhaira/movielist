<?php
include('connect.php'); 

// Ambil nilai 'id' dari URL
$id = $_GET['id'];

// Hapus data dari tabel 'movielist' berdasarkan id
if (mysqli_query($conn, "DELETE FROM movielist WHERE id='$id'")) {
    // Cek apakah masih ada data di tabel 'movielist'
    $check_query = "SELECT COUNT(*) as total FROM movielist"; //Hitng jmlh total data ditabel
    $result = mysqli_query($conn, $check_query); // Jalankan query untuk menghitung data
    $row = mysqli_fetch_assoc($result); // Ambil hasil query

    // Jika tidak ada data, reset AUTO_INCREMENT ke 1
    if ($row['total'] == 0) { // Cek apakah tabel kosong
        $reset_ai_query = "ALTER TABLE movielist AUTO_INCREMENT = 1"; // Reset AUTO_INCREMENT ke 1
        if (!mysqli_query($conn, $reset_ai_query)) {
            die('Error resetting AUTO_INCREMENT: ' . mysqli_error($conn));
        }
    }
} else {
    die('Error deleting record: ' . mysqli_error($conn));
}

// Redirect ke halaman homepage
header('Location: homepage.php'); // Kembali ke homepage setelah selesai
exit(); // Hentikan skrip setelah redirect
?>
