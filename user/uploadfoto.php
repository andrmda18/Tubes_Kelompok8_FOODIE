<?php
session_start();
include "../dbconfig.php";

// Pastikan username ada dalam session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil username dari session
} else {
    echo "Username tidak ditemukan!";
    exit();
}

$foto = ""; // Inisialisasi default untuk menghindari error

if (isset($_POST['btnSimpan'])) {
    $foto = $_FILES['foto'];
    if (!empty($foto['name'])) {
        $photoName = time() . '_' . $foto['name'];
        move_uploaded_file($foto['tmp_name'], '../images/' . $photoName);
        $foto = '../images/' . $photoName; // Set path gambar
    } else {
        $photoName = "";
        $foto = ""; // Jika tidak ada file yang diupload
    }

    // Simpan ke database
    $sqlStatment = "INSERT INTO tambahresep (username, foto, idKategori) VALUES ('$username', '$photoName', 0)";
    if (mysqli_query($conn, $sqlStatment)) {
        $IdResep = mysqli_insert_id($conn); // Mendapatkan ID resep
        mysqli_close($conn);

        // Redirect ke halaman berikutnya
        header("Location: editupload.php?IdResep=$IdResep");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="uploadfoto.css">
  <title>Upload Foto atau Video</title>
</head>
<body>
<div class="upload-container">
    <div class="upload-header">
      <h4>Buat Postingan Baru</h4>
      <hr>
    </div>
    <div class="upload-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="drag-area" id="drag-area">
          <img src="../images/upload.jpeg" alt="logo" width="70%" class="mb-3" id="preview">
          <p>Seret dan Lepaskan Foto/Video di Sini atau Klik untuk Pilih</p>
          <input type="file" id="foto" name="foto" accept="image/*,video/*" style="display: none;" required>
        </div>
        <button type="submit" name="btnSimpan" class="btn btn-primary mt-3">Upload</button>
      </form>
    </div>
  </div>

  <script>
    const dragArea = document.getElementById('drag-area');
    const fileInput = document.getElementById('foto');
    const previewImage = document.getElementById('preview');

    dragArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
      const file = fileInput.files[0];
      showPreview(file);
    });

    dragArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      dragArea.style.backgroundColor = '#f1f1f1';
    });

    dragArea.addEventListener('dragleave', () => {
      dragArea.style.backgroundColor = 'white';
    });

    dragArea.addEventListener('drop', (e) => {
      e.preventDefault();
      const file = e.dataTransfer.files[0];
      fileInput.files = e.dataTransfer.files;
      showPreview(file);
    });

    function showPreview(file) {
      const reader = new FileReader();
      reader.onload = () => previewImage.src = reader.result;
      reader.readAsDataURL(file);
    }
  </script>
</body>
</html>
