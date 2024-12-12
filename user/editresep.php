<?php
include "../dbconfig.php";

// Memastikan `IdResep` valid dan ada dalam URL
$IdResep = isset($_GET['IdResep']) ? intval($_GET['IdResep']) : 0;

if ($IdResep > 0) {
    // Ambil data resep berdasarkan ID
    $sqlStatement = "SELECT * FROM tambahresep WHERE IdResep = $IdResep";
    $query = mysqli_query($conn, $sqlStatement);

    if ($query && mysqli_num_rows($query) > 0) {
        $resep = mysqli_fetch_assoc($query);
        $nama = $resep['NamaResep'];
        $deskripsi = $resep['Deskripsi'];
        $bahan = $resep['Bahan'];
        $langkah = $resep['Langkah'];
        $durasi = $resep['Durasi'];
    } else {
        echo "Resep tidak ditemukan.";
        exit(); // Menghentikan eksekusi jika resep tidak ditemukan
    }
} else {
    echo "ID Resep tidak valid.";
    exit();
}

// Proses pengeditan resep
if (isset($_POST['btnSimpan'])) {
    $nama_baru = $_POST["NamaResep"];
    $deskripsi_baru = $_POST["Deskripsi"];
    $bahan_baru = $_POST["Bahan"];
    $langkah_baru = $_POST["Langkah"];
    $durasi_baru = $_POST["Durasi"];

    // Query untuk update data
    $updateSQL = "UPDATE tambahresep SET 
                  NamaResep = '$nama_baru', 
                  Deskripsi = '$deskripsi_baru',
                  Durasi = '$durasi_baru', 
                  Bahan = '$bahan_baru', 
                  Langkah = '$langkah_baru' 
                  WHERE IdResep = $IdResep";

    $updateQuery = mysqli_query($conn, $updateSQL);

    // Jika berhasil memperbarui data
    if ($updateQuery) {
        $successMsg = "Resep berhasil diperbarui!";
        header("Location: foto.php?IdResep=$IdResep&successMsg");
        exit();
    } else {
        $errMsg = "Gagal memperbarui resep! " . mysqli_error($conn);
        echo $errMsg; // Tampilkan pesan error
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
</head>
<body>
    <h2>Edit Resep</h2>
    <form method="post">
        <input type="hidden" name="IdResep" value="<?= $IdResep ?>">
        <input type="text" placeholder="Tambahkan Nama Resep..." name="NamaResep" maxlength="200" value="<?= htmlspecialchars($nama) ?>" required> <br>
        <textarea placeholder="Tambahkan Deskripsi..." name="Deskripsi" maxlength="200" required><?= htmlspecialchars($deskripsi) ?></textarea><br>
        <textarea placeholder="Tambahkan Bahan-bahannya..." name="Bahan"  required><?= htmlspecialchars($bahan) ?></textarea> <br>
        <textarea style="white-space: pre-wrap" placeholder="Tambahkan Langkah-langkahnya..." name="Langkah"  required><?= htmlspecialchars($langkah) ?></textarea> <br>
        <input type="text" placeholder="Tambahkan durasi" name="Durasi" value="<?= htmlspecialchars($durasi) ?>" required>
        <input class="submit" type="submit" name="btnSimpan" value="Simpan">
    </form>
</body>
</html>
