<?php
session_start();
include "dbconfig.php";
// Koneksi ke database

// Ambil data dari form
if (isset($_POST['btnRegister'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['kataSandi'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];
    $foto = $_FILES['foto'];

    // Menangani file foto
    if (!empty($foto['name'])) {
        $photoName = time() . '_' . $foto['name'];  // Nama file unik berdasarkan waktu
        move_uploaded_file($foto['tmp_name'], 'images/' . $photoName);  // Pindahkan file ke folder 'images'
    } else {
        $photoName = "";  // Jika tidak ada file yang diupload
    }

    // Periksa apakah username sudah ada
    $sql_check = "SELECT * FROM login WHERE username='$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        echo "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Simpan data pengguna baru, termasuk nama foto yang diupload
        $sql = "INSERT INTO login (username, nama, email, kataSandi, role, foto) VALUES ('$username', '$nama', '$email', '$password', '$role', '$photoName')";

        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman login.php setelah berhasil
            header("Location: login.php");
            exit; // Pastikan script berhenti setelah redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>REGISTER FOODIE</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="registrasi.css" />
    <link
      rel="stylesheet"
      href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900"
    />  
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row min-vh-100">
        <!-- Kolom Gambar di Kiri -->
        <div class="col-md-6 p-0">
          <img
            src="images/GAMBAR1.png"
            alt="FOODIE"
            class="img-fluid full-height"
          />
        </div>

        <!-- Kolom Konten di Kanan -->
        <div
          class="col-md-6 d-flex align-items-center justify-content-center text-center">
          <div class="form-section w-75">
            <img src="images/LOGO.png" alt="FOODIE" class="img-fluid mb-3" style="max-width: 30%; height: auto;" />
            <h1 style="color: #f09133"><b>Welcome!</b></h1>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <input type="text" id="username" name="username" class="form-control custom-outline" placeholder="Username" required />
                </div>
                <div class="mb-2">
                    <input type="text" id="nama" name="nama" class="form-control custom-outline" placeholder="Nama" required />
                </div>
                <div class="mb-2">
                    <input type="email" id="email" name="email" class="form-control custom-outline" placeholder="Email" required />
                </div>
                <div class="mb-2">
                    <input type="password" id="kataSandi" name="kataSandi" class="form-control custom-outline" placeholder="Password" required />
                </div>
                <div class="mb-2">
                  <input type="hidden" id="role" name="role" value="user"/>
                    <!-- <select class="form-control custom-outline" id="role" name="role" required>
                    <option value="" disabled selected>Pilih Role</option> Pilihan default yang tidak dapat dipilih -->
                    <!-- <option value="admin">Admin</option>
                    <option value="user">User</option>
                    </select>  -->
                </div>

                <!-- Tampilan Input File dengan Style Sama -->
                <div class="mb-2">
                    <div class="input-group">
                    <input type="text" id="fileName" class="form-control custom-outline" placeholder="Pilih Foto Profil" disabled />
                    <label class="input-group-text" for="foto">Pilih</label>
                    </div>
                    <input type="file" id="foto" name="foto" class="form-control custom-outline d-none" accept="image/*" onchange="updateFileName(event)" required />
                </div>

                <!-- Menampilkan Nama File yang Dipilih -->
                <div id="file-name" class="file-name"></div>

                <p class="line-text-alternate my-1">ATAU</p>
                <img src="images/Google.png" alt="google" width="8%" height="5%" />
                <span class="google-signup"><a href="logingoogle.html">Daftar dengan Google</a></span>
                
                <div class="d-grid gap-1">
                    <button class="btn btn-primary rounded-pill" type="submit" name="btnRegister">DAFTAR</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mengganti teks input dengan nama file yang dipilih
        function updateFileName(event) {
            var fileName = event.target.files[0].name;
            document.getElementById('fileName').value = fileName;  // Mengubah nilai input file-name menjadi nama file
        }
    </script>
  </body>
</html>