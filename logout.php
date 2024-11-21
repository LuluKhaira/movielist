<?php
// Menghancurkan semua data sesi yang ada, mengakhiri sesi pengguna saat ini
session_destroy(); 

// Mengarahkan pengguna ke halaman "index.php" setelah sesi dihancurkan
header("location: index.php"); 
?>
