<?php
include "../dbconfig.php"; // Memastikan file konfigurasi database diimpor dengan benar

// Mendapatkan ID komunitas dari parameter URL
if (isset($_GET['komunitas_id'])) {
    $komunitas_id = $_GET['komunitas_id'];

    // Query untuk menghapus komunitas berdasarkan ID
    $sqlDelete = "DELETE FROM komunitas WHERE id = '$komunitas_id'";

    if (mysqli_query($conn, $sqlDelete)) {
        // Redirect ke halaman daftar komunitas dengan pesan sukses
        $successMsg = "Komunitas berhasil dihapus!";
        header("Location: indexdetail.php?successMsg=" . urlencode($successMsg));
        exit;
    } else {
        // Tampilkan pesan error jika gagal menghapus komunitas
        echo "Gagal menghapus komunitas: " . mysqli_error($conn);
    }
} else {
    echo "ID komunitas tidak ditemukan!";
}

mysqli_close($conn); // Tutup koneksi database
?>
