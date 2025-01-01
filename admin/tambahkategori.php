<?php
include "../dbconfig.php";

// Variabel untuk pesan sukses atau error
$message = "";

// Ambil data kategori dan jumlah resep dari database
$sqlStatement = "
    SELECT k.namaKategori, k.foto, COUNT(r.IdResep) AS jumlah_resep
    FROM kategori k
    LEFT JOIN tambahresep r ON k.idKategori = r.IdKategori
    WHERE k.idKategori !=0
    GROUP BY k.idKategori, k.namaKategori, k.foto";
$result = mysqli_query($conn, $sqlStatement);

if (isset($_POST['btnSimpan'])) {
    // Ambil data dari form
    $namaKategori = $_POST['namaKategori'];
    $foto = $_FILES['foto'];

    if (!empty($foto['name'])) {
        // Upload file
        $photoName = time() . '_' . $foto['name'];
        $uploadPath = '../images/' . $photoName;

        if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
            // Simpan ke database
            $sqlStatment = "INSERT INTO kategori (namaKategori, foto) VALUES ('$namaKategori', '$photoName')";
            if (mysqli_query($conn, $sqlStatment)) {
                $message = "Kategori berhasil ditambahkan!";
                // Refresh data kategori
                $result = mysqli_query($conn, $sqlStatement);
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        } else {
            $message = "Gagal mengupload gambar!";
        }
    } else {
        $message = "Harap upload gambar!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Kategori</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="tambahkategori.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-1 p-0 sidebar">
          <ul>
            <li><a href="../logout.php"><img src="../images/LOGO.png" alt="logo" /></li></a>
            <li><a href="tambahkategori.php"><i class="bi bi-collection"></i></a></li>
            <li><a href="index.php"><i class="bi bi-folder-check"></i></a></li>
            <li><a href="konfirmasitopup.php"><i class="bi bi-coin"></i></a></li>
            <li><a href="konfirmasitarik.php"><i class="bi bi-wallet2"></i></a></li>
          </ul>
        </div>
        <div class="col main-content">
          <div class="container">
            <div class="header">
              <span class="title">Tambah Kategori</span>
            </div>
            <?php if (!empty($message)) : ?>
              <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <div class="form-tambah-kategori mb-4">
              <form method="POST" enctype="multipart/form-data" class="d-flex flex-column">
                <input
                  type="text"
                  name="namaKategori"
                  class="form-control mb-2"
                  placeholder="Nama Kategori"
                  required
                />
                <input
                  type="file"
                  name="foto"
                  class="form-control mb-2"
                  required
                />
                <div class="d-flex justify-content-end gap-2 mt-3">
                  <button type="submit" name="btnSimpan" class="btn btn-success">Konfirmasi</button>
                </div>
              </form>
            </div>
            <div class="komunitas-list">
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="komunitas-item">
                  <img src="../images/<?= htmlspecialchars($row['foto']) ?>" alt="Foto Kategori" />
                  <span><?= htmlspecialchars($row['namaKategori']) ?></span>
                  <span><?= htmlspecialchars($row['jumlah_resep']) ?> Resep</span>
                  <button class="btn btn-success">Edit</button>
                  <button class="btn btn-danger">Hapus</button>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
