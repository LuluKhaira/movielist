<?php
include('connect.php'); // Menghubungkan ke database
?>

<head>
    <!-- Menyertakan Bootstrap CSS untuk styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5"> <!-- Membuat container dengan margin top 5 -->
        <div class="row justify-content-center"> <!-- Menempatkan row di tengah halaman -->
            <div class="col-md-8"> <!-- Mengatur lebar kolom sebesar 8 grid -->
                <div class="card"> <!-- Membuat elemen card untuk form -->
                    <div class="card-header text-center"> <!-- menampilakan dan tengah -->
                        <h1>Edit Movie</h1> <!-- Judul halaman -->
                    </div>
                    <div class="card-body"> <!-- Bagian body card, tempat form berada -->
                        <?php
                        $id = $_GET['id']; // Ambil 'id' dari URL
                        $data = mysqli_query($conn, "SELECT * FROM movielist WHERE id='$id'"); // Ambil data film berdasarkan 'id' dari tabel 'movielist'
                        while ($d = mysqli_fetch_array($data)) { //menampilkan data yg didptkn ke dalam form
                        ?>
                            <form action="edit_aksi.php" method="POST">
                                <!-- Menyimpan 'id' film yang akan diedit, disembunyikan dari user -->
                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>"> 

                                <!-- Input untuk Judul Film -->
                                <div class="form-group">
                                    <label for="judul_film">Judul Film:</label>
                                    <input type="text" name="judul_film" id="judul_film" class="form-control" value="<?php echo $d['judul_film']; ?>" required oninvalid="this.setCustomValidity('Isi terlebih dahulu Judul nya')" oninput="this.setCustomValidity('')">
                                </div>

                                <!-- Input untuk Genre Film -->
                                <div class="form-group">
                                    <label for="genre">Genre:</label>
                                    <!-- Menampilkan data genre film yang ada, dengan validasi wajib diisi -->
                                    <input type="text" name="genre" id="genre" class="form-control" value="<?php echo $d['genre']; ?>" required oninvalid="this.setCustomValidity('Isi terlebih dahulu Genre nya')" oninput="this.setCustomValidity('')">
                                </div>

                                <!-- Input untuk Tahun Terbit Film -->
                                <div class="form-group">
                                    <label for="tahun_terbit">Tahun Terbit:</label>
                                    <!-- Menampilkan data tahun terbit film yang ada, dengan validasi wajib diisi -->
                                    <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="<?php echo $d['tahun_terbit']; ?>" required oninvalid="this.setCustomValidity('Isi terlebih dahulu Tahun nya')" oninput="this.setCustomValidity('')">
                                </div>

                                <!-- Input untuk Penulis Film -->
                                <div class="form-group">
                                    <label for="penulis">Penulis:</label>
                                    <!-- Menampilkan data penulis film yang ada, dengan validasi wajib diisi -->
                                    <input type="text" name="penulis" id="penulis" class="form-control" value="<?php echo $d['penulis']; ?>" required oninvalid="this.setCustomValidity('Isi terlebih dahulu Penulis nya')" oninput="this.setCustomValidity('')">
                                </div>

                                <!-- Tombol untuk menyimpan perubahan ke 'edit_aksi.php' -->
                                <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button> 
                                <!-- Tombol untuk membatalkan pengisian form dan kembali ke homepage -->
                                <a href="homepage.php" class="btn btn-info btn-block">Cancel</a>
                            </form>
                        <?php
                        }
                        ?>
                    </div> 
                </div>
            </div> 
        </div> 
    </div>
</body>
</html>
