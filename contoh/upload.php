<?php
include "../dbconfig.php"; // Koneksi database

if (isset($_POST['btnSimpan'])) {
    $foto = $_FILES['foto'];

    if (!empty($foto['name'])) {
        $photoName = time() . '_' . $foto['name'];
        move_uploaded_file($foto['tmp_name'], 'images/' . $photoName);
    } else {
        $photoName = "";
    }

    $sqlStatment = "INSERT INTO tambahresep (foto) VALUES ('$photoName')";
    $query = mysqli_query($conn, $sqlStatment);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="uploadfoto.css">
  <title>Upload Foto atau Video</title>
  <style>
    .upload-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 400px;
    }

    .upload-header h4 {
        margin-bottom: 10px;
    }

    .drag-area {
        border: 2px dashed #aaa;
        padding: 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .drag-area:hover {
        border-color: #85cddb;
        background-color: #f5f5f5;
    }

    .drag-area img {
        max-width: 100%;
        display: block;
        margin: 10px auto;
    }

    .drag-area p {
        font-size: 14px;
        color: #888;
    }

    .next-button {
        float: right;
        color: #f09133;
        text-decoration: none;
    }

    .btn-primary {
        background-color: #85cddb;
        border: none;
    }

    .btn-primary:hover {
        background-color: #007bff;
    }
  </style>
</head>
<body>
  <div class="upload-container">
    <div class="upload-header">
      <a href="#" class="next-button">Berikutnya</a>
      <h4>Buat Postingan Baru</h4>
      <hr>
    </div>
    <div class="upload-body">
      <form action="upload_foto_video.php" method="POST" enctype="multipart/form-data">
        <div class="drag-area" id="drag-area">
          <img src="../images/upload.jpeg" alt="logo" width="70%" class="mb-3" id="preview">
          <p>Seret dan Lepaskan Foto/Video di Sini atau Klik untuk Pilih</p>
          <input type="file" id="foto" name="foto" accept="image/*,video/*" style="display: none;" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
