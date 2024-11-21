<?php
session_start(); // Memulai sesi untuk menyimpan informasi pengguna 
include("connect.php"); // Menghubungkan ke database


$email = $_SESSION['email']; // Mendapatkan email pengguna dari sesi

// Mengambil detail pengguna dari database
$stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?"); // Menyiapkan statement SQL
$stmt->bind_param("s", $email); // Mengikat parameter email
$stmt->execute(); // Menjalankan statement
$user = $stmt->get_result()->fetch_assoc(); // Mengambil hasil sebagai array asosiatif
$stmt->close(); // Menutup statement
?>

<head>
    <title>Homepage</title>
    <!-- Menyertakan Bootstrap CSS versi 5.0.2 untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="navbar.css"> <!-- KE FILE NAVBAR!!! -->
</head>

<body>
    <nav class="shadow navbar navbar-expand-lg navbar-dark bg-dark"> <!-- ~bayangan movielits -->
        <div class="container-fluid"> <!-- Mengatur kontainer navbar -->
            <span class="navbar-logo">Movie<span>List</span></span> <!-- Logo navbar -->

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Form pencarian yang mengirimkan keyword melalui GET -->
                <form class="d-flex ms-auto" method="GET" action="">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Cari..."
                        aria-label="Search"
                        value="<?php echo htmlspecialchars(isset($_GET['keyword']) ? $_GET['keyword'] : ''); ?>">
                    <!-- Menampilkan keyword jika ada -->
                    <button class="btn btn-outline-light" type="submit">Cari</button> <!-- Tombol untuk mencari -->
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <h5 class="nav-link ms-3 me-2">
                            <?php
                            if ($user) {
                                // Menampilkan salam dengan nama pengguna jika tersedia
                                echo 'Hello, ' . htmlspecialchars($user['firstName'] . ' ' . $user['lastName']);
                            } else {
                                // Menampilkan hello
                                echo 'Hello';
                            }
                            ?>
                        </h5>
                    </li>
                    <li class="nav-item">
                        <!-- Link untuk logout -->
                        <a class="nav-link" href="logout.php"
                            onclick="return confirm('Beneran ni mau logout?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4"> <!-- mengatur jarak navbar dgn bawah --> 
        <div class="d-flex justify-content-end mb-3"> <!-- Mengatur tombol add new ke kanan -->
            <a class="btn btn-primary" href="create.php">Add New</a> <!-- Tombol untuk menambahkan data film baru -->
        </div>
        <table class="table"> <!-- Tabel untuk menampilkan daftar film -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Film</th>
                    <th>Genre</th>
                    <th>Tahun Terbit</th>
                    <th>Penulis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil keyword dari parameter GET dan menggunakannya untuk filter data
                $keyword = isset($_GET['keyword']) ? '%' . mysqli_real_escape_string($conn, $_GET['keyword']) . '%' : '%';
                $stmt = $conn->prepare("SELECT * FROM movielist WHERE judul_film LIKE ? OR genre LIKE ? OR tahun_terbit LIKE ? OR penulis LIKE ?");
                $stmt->bind_param("ssss", $keyword, $keyword, $keyword, $keyword); // Mengikat parameter pencarian ke query
                $stmt->execute(); // Menjalankan query
                $result = $stmt->get_result(); // Mengambil hasil query
                
                while ($d = $result->fetch_assoc()) { // Mengiterasi setiap baris hasil query
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($d['id']); ?></td> <!-- Menampilkan ID film -->
                        <td><?php echo htmlspecialchars($d['judul_film']); ?></td> <!-- Menampilkan judul film -->
                        <td><?php echo htmlspecialchars($d['genre']); ?></td> <!-- Menampilkan genre film -->
                        <td><?php echo htmlspecialchars($d['tahun_terbit']); ?></td> <!-- Menampilkan tahun terbit -->
                        <td><?php echo htmlspecialchars($d['penulis']); ?></td> <!-- Menampilkan penulis film -->
                        <td>
                            <!-- Tombol untuk mengedit data film -->
                            <a href="edit.php?id=<?php echo htmlspecialchars($d['id']); ?>"
                                class="btn btn-warning btn-sm">Edit</a>
                            <!-- Tombol untuk menghapus data film dengan konfirmasi -->
                            <a onclick="return confirm('Yakin mau dihapus?')"
                                href="delete.php?id=<?php echo htmlspecialchars($d['id']); ?>"
                                class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                $stmt->close(); // Menutup statement setelah selesai
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
