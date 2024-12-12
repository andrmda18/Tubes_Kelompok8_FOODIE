<?php
session_start();
include "../dbconfig.php";

// Memastikan username ada dalam session
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username']; // Ambil username dari session
} else {
  echo "Username tidak ditemukan!";
  exit();
}

// Memastikan IdResep valid dan ada dalam URL
$IdResep = isset($_GET['IdResep']) ? intval($_GET['IdResep']) : 0;

if ($IdResep > 0) {
  // Ambil data resep berdasarkan IdResep
  $sqlGetResep = "SELECT * FROM tambahresep WHERE IdResep = $IdResep";
  $result = mysqli_query($conn, $sqlGetResep);

  if ($row = mysqli_fetch_assoc($result)) {
      $foto = $row['foto'];
      $nama = $row['NamaResep'] ?? '';
      $deskripsi = $row['Deskripsi'] ?? '';
      $durasi = $row['Durasi'] ?? '';
      $bahan = $row['Bahan'] ?? '';
      $langkah = $row['Langkah'] ?? '';
  } else {
      die("Resep tidak ditemukan!");
  }
}
if (isset($_POST['btnSimpan'])) {
    // Ambil data dari form
    $nama = $_POST['NamaResep'];
    $deskripsi = $_POST['Deskripsi'];
    $durasi = $_POST['Durasi'];
    $bahan = $_POST['Bahan'];
    $langkah = $_POST['Langkah'];

    // Simpan detail resep ke dalam tabel
    $sqlStatment = "UPDATE tambahresep SET NamaResep='$nama', Deskripsi='$deskripsi', Durasi='$durasi', Bahan='$bahan', Langkah='$langkah' WHERE IdResep=$IdResep";
    $query = mysqli_query($conn, $sqlStatment);

    if ($query) {
      header("Location: home.php?IdResep=$IdResep&successMsg=Data resep berhasil diperbarui.");
      exit();
  } else {
      echo "Gagal memperbarui data resep: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit postingan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="editupload.css" />
  <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body>
    <div class="post-modal">
    <img src="../images/<?= htmlspecialchars($foto) ?>" alt="Foto Resep" class="post-image">
        <form action="" method="POST">
          <input type="text" name="NamaResep" value="<?= htmlspecialchars($nama) ?>" placeholder="Tambahkan Judul..." maxlength="200">
          <textarea name="Deskripsi" placeholder="Tambahkan Deskripsinya..." maxlength="200"><?= htmlspecialchars($deskripsi) ?></textarea>
          <textarea style="white-space: pre-wrap" name="Bahan" placeholder="Tambahkan Bahan-bahannya..." ><?= htmlspecialchars($bahan) ?></textarea>
          <textarea style="white-space: pre-wrap" name="Langkah" placeholder="Tambahkan Langkah-langkahnya..." ><?= htmlspecialchars($langkah) ?></textarea>
          <input type="text" name="Durasi" value="<?= htmlspecialchars($durasi) ?>" placeholder="Tambahkan Durasi..." maxlength="200">
          <button type="submit" name="btnSimpan">Simpan</button>
        </form>
    </div>
</body>
</html>