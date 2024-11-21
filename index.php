<?php
include 'connect.php'; // memskn ke hph

// Memproses 
if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName']; // Mengambil nama depan 
    $lastName = $_POST['lName']; 
    $email = $_POST['email']; 
    // Meng-enkripsi password menggunakan MD5 agar informasi menajdi kode rahasia
    $password = md5($_POST['password']);

    // Mengecek apakah email sudah ada di database
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        // Jika email sudah ada,menmpilkan pesn kesalahan dan mengalihkan kehalaman index.php.
        echo "<script>alert('Email Address Already Exists!'); window.location.href='index.php';</script>";
    } else {
        // Jika email belm ada, menyimpan data pengguna ke database
        if ($conn->query("INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')")) {
            // Jika pendftran berhsil, menmpilkan pesn sukses dan menglihkn ke halmn index.php
            echo "<script>alert('Registration Successful!'); window.location.href='index.php';</script>";
        } else {
            // Jika terjadi kesalahan, menampilkan pesan kesalahan dan mengalihkan ke halaman index.php
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='index.php';</script>";
        }
    }
}

// Memproses login pengguna
if (isset($_POST['signIn'])) {
    $email = $_POST['email']; // Mengambil email dari formulir
    $password = md5($_POST['password']); 

    // Mengecek apakah email dan password cocok dengan data di database
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    if ($result->num_rows > 0) {
        // Jika email dan password cocok, memulai sesi dan menyimpan email ke sesi
        session_start();
        $_SESSION['email'] = $result->fetch_assoc()['email'];
        header("Location: homepage.php"); // Mengalihkan ke halaman homepage.php
        exit();
    } else {
        // Jika email atau password tidak cocok, menampilkan pesan kesalahan dan mengalihkan ke halaman index.php
        echo "<script>alert('Not Found, Incorrect Email or Password'); window.location.href='index.php';</script>";
    }
}
?>


<head>
  <title>Register & Login</title>
  <!-- Menyertakan Bootstrap CSS untuk desain responsif dan komponen UI -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<br></br><br></br>
<body>
  <div class="container mt-4 ">
    <div class="row d-flex justify-content-center ">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
           
            <!-- Formulir Sign Up -->
            <div id="signupForm"> <!-- Bagian ini untuk formulir pendaftaran -->
              <h4 class="card-title text-center">Sign Up</h4> <!-- Judul formulir agr d tngh Sign Up -->
              <form method="post"> <!-- Formulir dengan metode POST -->
                <div class="form-group"> <!-- Grup input untuk First Name -->
                  <label for="fName"><i class="fas fa-user"></i> First Name</label>
                  <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" required oninvalid="this.setCustomValidity('Isi First Name nya')" oninput="this.setCustomValidity('')"> <!-- Input untuk First Name -->
                </div>
                <div class="form-group"> <!-- Grup input untuk Last Name -->
                  <label for="lName"><i class="fas fa-user"></i> Last Name</label>
                  <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" required oninvalid="this.setCustomValidity('Isi Last Name nya')" oninput="this.setCustomValidity('')"> <!-- Input untuk Last Name -->
                </div>
                <div class="form-group"> <!-- Grup input untuk Email -->
                  <label for="email"><i class="fas fa-envelope"></i> Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Isi Email nya')" oninput="this.setCustomValidity('')"> <!-- Input untuk Email -->
                </div>
                <div class="form-group"> <!-- Grup input untuk Password -->
                  <label for="password"><i class="fas fa-lock"></i> Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Isi Password nya')" oninput="this.setCustomValidity('')"> <!-- Input untuk Password -->
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="signUp">Sign Up</button> <!-- Tombol untuk mengirim formulir Sign Up -->
                <p class="text-center mt-3">
                  Already have an account? <a href="#" onclick="toggleForm()">Sign In</a> <!-- Tautan untuk beralih ke formulir Sign In -->
                </p>
              </form>
            </div>

            <!-- Formulir Sign In -->
            <div id="signInForm" style="display: none;"> <!-- formulir login, awalnya disembunyikan -->
              <h3 class="card-title text-center">Sign In</h3> <!-- Judul formulir Sign In -->
              <form method="post"> <!-- Formulir dengan metode POST-->
                <div class="form-group"> <!-- Grup input untuk Email -->
                  <label for="email"><i class="fas fa-envelope"></i> Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Isi Email nya')" oninput="this.setCustomValidity('')"> <!-- Input untuk Email -->
                </div>
                <div class="form-group"> <!-- Grup input untuk Password -->
                  <label for="password"><i class="fas fa-lock"></i> Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required oninvalid="this.setCustomValidity('Tidak Lupa kan ama Password nya?')" oninput="this.setCustomValidity('')"> <!-- Input untuk Password -->
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="signIn">Sign In</button> <!-- Tombol untuk mengirim formulir Sign In -->
                <p class="text-center mt-3">
                  Don't have an account? <a href="#" onclick="toggleForm()">Sign Up</a> <!-- Tautan untuk beralih ke formulir Sign Up -->
                </p>
              </form>
            </div>
          </br>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Fungsi JavaScript untuk bergantian antara formulir Sign Up dan Sign In
    function toggleForm() {
      // Menukar tampilan formulir antara "block" (ditampilkan) dan "none" (disembunyikan)
      signupForm.style.display = signupForm.style.display === 'none' ? 'block' : 'none';
      signInForm.style.display = signInForm.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>
