<?php
// Menghubungkan ke file connect.php untuk mengakses koneksi database
include('connect.php');
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Create New Movie</title> <!-- Menentukan judul halaman -->
</head>
<body>
    <div class="container mt-5"> <!-- Membuat kontainer dengan margin top 5 -->
        <div class="row justify-content-center"> <!-- Mengatur row agr berda ditengah halaman -->
            <div class="col-md-8"> <!-- Mengatur lebar kolom sebesar 8 grid dari 12 grid -->
                <div class="card"> <!-- Membuat elemen card untuk form -->
                    <div class="card-header text-center"> <!-- Bagian header card,berada di tengah -->
                        <h1>Create New Movie</h1> <!-- Judul form yang ditampilkan -->
                    </div>
                    <div class="card-body"> <!-- Bagian body card, tempat form berada -->
                        <!-- Form yg akn mengirim data ke"create_aksi.php" menggunakan metode POST -->
                        <form action="create_aksi.php" method="POST">
                            <!-- Input untuk Judul Film -->
                            <div class="form-group">
                                <label for="judul_film">Judul Film: </label>
                                <!-- Input field untuk judul film, wajib diisi dengan validasi pesan error -->
                                <input type="text" name="judul_film" id="judul_film" class="form-control" required 
                                oninvalid="this.setCustomValidity('Isi terlebih dahulu Judul nya')" oninput="this.setCustomValidity('')">
                            </div>
                            <!-- Input untuk Genre Film -->
                            <div class="form-group">
                                <label for="genre">Genre:</label>
                                <!-- Input field untuk genre film, wajib diisi dengan validasi pesan error -->
                                <input type="text" name="genre" id="genre" class="form-control" required 
                                oninvalid="this.setCustomValidity('Isi terlebih dahulu Genre nya')" oninput="this.setCustomValidity('')">
                            </div>
                            <!-- Input untuk Tahun Terbit Film -->
                            <div class="form-group">
                                <label for="tahun_terbit">Tahun Terbit:</label>
                                <!-- Input field untuk tahun terbit film, wajib diisi dengan validasi pesan error -->
                                <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" required 
                                oninvalid="this.setCustomValidity('Isi terlebih dahulu Tahun nya')" oninput="this.setCustomValidity('')">
                            </div>
                            <!-- Input untuk Penulis Film -->
                            <div class="form-group">
                                <label for="penulis">Penulis:</label>
                                <!-- Input field untuk penulis film, wajib diisi dengan validasi pesan error -->
                                <input type="text" name="penulis" id="penulis" class="form-control" required 
                                oninvalid="this.setCustomValidity('Isi terlebih dahulu Penulis nya')" oninput="this.setCustomValidity('')">
                            </div>
                            <!-- Tombol untuk mengirimkan form ke "create_aksi.php" -->
                            <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                            <!-- Tombol untuk membatalkan pengisian form dan kembali ke homepage -->
                            <a href="homepage.php" class="btn btn-info btn-block">Cancel</a>
                        </form>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</body>
</html>
