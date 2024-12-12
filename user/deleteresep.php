<?php
include "../dbconfig.php"; // Pastikan path file konfigurasi database sesuai

// Mendapatkan ID Resep dari parameter URL
if (isset($_GET['IdResep'])) {
    $IdResep = $_GET['IdResep'];

    // Query untuk menghapus resep berdasarkan ID
    $sqlDelete = "DELETE FROM tambahresep WHERE IdResep = '$IdResep'";

    if (mysqli_query($conn, $sqlDelete)) {
        // Redirect ke halaman rumah.php dengan pesan sukses
        $successMsg = "Resep berhasil dihapus!";
        header("Location: home.php?successMsg=" . urlencode($successMsg));
        exit;
    } else {
        // Tampilkan pesan error jika gagal menghapus resep
        echo "Gagal menghapus resep: " . mysqli_error($conn);
    }
} else {
    echo "ID resep tidak ditemukan!";
}

mysqli_close($conn); // Tutup koneksi database
?>
