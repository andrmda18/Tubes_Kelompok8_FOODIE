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

$sqlStatment = "SELECT * FROM kategori WHERE idKategori != 0";
$query = mysqli_query($conn, $sqlStatment);

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
      $idKategori = $row['idKategori']?? '';
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
    $idKategori = $_POST['idKategori'];

    // Simpan detail resep ke dalam tabel
    $sqlStatment = "UPDATE tambahresep SET NamaResep='$nama', Deskripsi='$deskripsi', Durasi='$durasi', Bahan='$bahan', Langkah='$langkah', idKategori='$idKategori' WHERE IdResep=$IdResep";
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

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit postingan</title>

  <link href="editupload.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=League+Spartan:wght@100..900" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
<style>
/* Styling Umum */
body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
    }

    .main-container {
      display: flex;
      height: 100vh;
      overflow-y: auto;
    }

    /* Sidebar */
    .sidebar {
      width: 20%;
      background-color: #343a40;
      color: #fff;
      padding: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      padding: 10px 15px;
      cursor: pointer;
      color: #adb5bd;
    }

    .sidebar li:hover,
    .sidebar li.active {
      background-color: #495057;
      font-weight: bold;
      color: #fff;
      border-radius: 5px;
    }

    /* Konten */
    .content {
      width: 80%;
      padding: 20px;
      background-color: #fff;
      overflow-y: auto;

    }

    /* Modal Overlay */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      z-index: 10;
      overflow-y: auto;
    }

    /* Modal */
    .post-modal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      max-width: 600px;
      width: 100%;
      z-index: 20;
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-height: 90vh; /* Batasi tinggi modal */
  overflow-y: auto; /* Scroll untuk modal */
    }

    .post-modal img {
      max-width: 100%;
      border-radius: 10px;
    }

    .post-modal form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .post-modal form input,
    .post-modal form textarea,
    .post-modal form select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      font-size: 14px;
    }

    .post-modal form textarea {
      resize: none;
    }

    .post-modal form button {
      background-color: #0d6efd;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .post-modal form button:hover {
      background-color: #0b5ed7;
    }

    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .content {
        width: 100%;
      }
    }

</style>
</head>

<body>
    <div class="post-modal">
    <img src="../images/<?= htmlspecialchars($foto) ?>" alt="Foto Resep" class="post-image">
        <form action="" method="POST">
          <input type="text" name="NamaResep" value="<?= htmlspecialchars($nama) ?>" placeholder="Tambahkan Judul..." maxlength="200">
          <textarea name="Deskripsi" placeholder="Tambahkan Deskripsinya..." maxlength="250"><?= htmlspecialchars($deskripsi) ?></textarea>
          <textarea style="white-space: pre-wrap" name="Bahan" placeholder="Tambahkan Bahan-bahannya..." ><?= htmlspecialchars($bahan) ?></textarea>
          <textarea style="white-space: pre-wrap" name="Langkah" placeholder="Tambahkan Langkah-langkahnya..." ><?= htmlspecialchars($langkah) ?></textarea>
          <input type="text" name="Durasi" value="<?= htmlspecialchars($durasi) ?>" placeholder="Tambahkan Durasi..." maxlength="200">
          <select name="idKategori" id="idKategori" required>
              <option value="" disabled selected>-- Pilih Kategori --</option>
              <?php
              while ($row = mysqli_fetch_assoc($query)) {
                  echo "<option value='" . $row['idKategori'] . "'>" . $row['namaKategori'] . "</option>";
              }
              ?>
          </select><br>
          <button type="submit" name="btnSimpan">Simpan</button>
        </form>
    </div>
</body>
</html>