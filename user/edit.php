<?php
include "../dbconfig.php"; // Memastikan file konfigurasi database diimpor dengan benar

// Mendapatkan ID komunitas dari parameter URL
if (isset($_GET['komunitas_id'])) {
    $komunitas_id = $_GET['komunitas_id'];
} else {
    echo "Komunitas tidak ditemukan!";
    exit;
}

// Mengambil data komunitas yang ingin diedit
$sqlKomunitas = "SELECT * FROM komunitas WHERE id = '$komunitas_id'";
$resultKomunitas = mysqli_query($conn, $sqlKomunitas);
$komunitas = mysqli_fetch_assoc($resultKomunitas);

// Proses jika form disubmit untuk menyimpan perubahan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_komunitas = $_POST['nama_komunitas'];
    $deskripsi = $_POST['deskripsi'];

    // Validasi input
    if (empty($nama_komunitas) || empty($deskripsi)) {
        echo "Semua field wajib diisi!";
        exit;
    }

    // Query untuk mengupdate data komunitas
    $sqlUpdate = "UPDATE komunitas SET nama_komunitas = '$nama_komunitas', deskripsi = '$deskripsi' WHERE id = '$komunitas_id'";

    if (mysqli_query($conn, $sqlUpdate)) {
        $successMsg = "Komunitas berhasil diperbarui!";
        header("Location: indexdetail.php?successMsg=" . urlencode($successMsg));
        exit;
    } else {
        echo "Gagal mengupdate komunitas: " . mysqli_error($conn);
    }
}

mysqli_close($conn); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komunitas</title>
</head>
<body>
    <h1>Edit Komunitas</h1>
    
    <!-- Menampilkan pesan sukses jika ada -->
    <?php if (isset($successMsg)): ?>
        <p style="color: green;"><?= htmlspecialchars($successMsg) ?></p>
    <?php endif; ?>

    <!-- Form untuk mengedit komunitas -->
    <form action="" method="POST">
        <label for="nama_komunitas">Nama Komunitas:</label><br>
        <input type="text" id="nama_komunitas" name="nama_komunitas" value="<?= htmlspecialchars($komunitas['nama_komunitas']) ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($komunitas['deskripsi']) ?></textarea><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="indexdetail.php">Kembali ke Daftar Komunitas</a>
</body>
</html>
