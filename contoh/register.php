<?php
session_start();
include "../dbconfig.php";
// Koneksi ke database

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
if (isset($_POST['btnRegister'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['kataSandi'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role'];

    // Menangani Upload Foto Profil
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $temp_name = $_FILES['foto']['tmp_name'];
        $upload_dir = '../uploads/';
        $foto_path = $upload_dir . basename($foto);

        // Pindahkan file gambar ke direktori upload
        if (move_uploaded_file($temp_name, $foto_path)) {
            // Simpan data pengguna baru termasuk foto profil
            $sql = "INSERT INTO login (username, nama, email, kataSandi, role, foto) 
                    VALUES ('$username', '$nama', '$email', '$password', '$role', '$foto')";
            if ($conn->query($sql) === TRUE) {
                // Redirect ke halaman login.php setelah berhasil
                header("Location: login.php");
                exit; // Pastikan script berhenti setelah redirect
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="registrasi.css" />
    <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" />
    <style>
      /* Custom styles for file input */
      .custom-file-input {
        display: none;
      }

      .custom-file-label {
        display: block;
        width: 100%;
        height: 40px;
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        cursor: pointer;
        text-align: center;
      }

      .custom-file-label:hover {
        background-color: #f1f1f1;
      }

      /* Styling for the file name display */
      .file-name {
        margin-top: 10px;
        font-size: 14px;
        color: #555;
      }

      .file-name span {
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row min-vh-100">
        <!-- Kolom Gambar di Kiri -->
        <div class="col-md-6 p-0">
          <img src="../images/GAMBAR1.png" alt="FOODIE" class="img-fluid full-height" />
        </div>

        <!-- Kolom Konten di Kanan -->
        <div class="col-md-6 d-flex align-items-center justify-content-center text-center">
          <div class="form-section w-75">
            <img src="../images/LOGO.png" alt="FOODIE" class="img-fluid mb-3" style="max-width: 30%; height: auto;" />
            <h1 style="color: #f09133;"><b>Welcome!</b></h1>
            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" id="username" name="username" class="form-control custom-outline" placeholder="Username" required />
              </div>
              <div class="mb-3">
                <input type="text" id="nama" name="nama" class="form-control custom-outline" placeholder="Nama" required />
              </div>
              <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control custom-outline" placeholder="Email" required />
              </div>
              <div class="mb-3">
                <input type="password" id="kataSandi" name="kataSandi" class="form-control custom-outline" placeholder="Password" required />
              </div>
              <div class="mb-3">
                <select class="form-control custom-outline" id="role" name="role" required>
                  <option value="" disabled selected>Pilih Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>

              <!-- Tombol Pilih Foto Profil -->
              <div class="mb-3">
                <label for="foto" class="custom-file-label" id="foto-label">Pilih Foto Profil</label>
                <input type="file" id="foto" name="foto" class="custom-file-input" accept="image/*" onchange="updateLabelWithFileName(event)" required />
              </div>

              <!-- Menampilkan Nama File yang Dipilih -->
              <div id="file-name" class="file-name"></div>

              <p class="line-text-alternate my-2">ATAU</p>
              <img src="../images/Google.png" alt="google" width="8%" height="5%" />
              <span class="google-signup"><a href="logingoogle.html">Daftar dengan Google</a></span>
              <div class="d-grid gap-2">
                <button class="btn btn-primary rounded-pill" type="submit" name="btnRegister">DAFTAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Fungsi untuk mengganti teks label dengan nama file yang dipilih
      function updateLabelWithFileName(event) {
        var fileName = event.target.files[0].name;
        document.getElementById('foto-label').textContent = fileName;  // Mengubah teks label dengan nama file
      }
    </script>
  </body>
</html>
