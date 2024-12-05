<?php
include "../dbconfig.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idresep = $_POST['idresep']; // Ambil ID Resep dari form
    $keterangan = $_POST['keterangan']; // Ambil nilai keterangan (Disetujui/Ditolak)

    // Sanitasi input untuk keamanan
    $idresep = mysqli_real_escape_string($conn, $idresep);
    $keterangan = mysqli_real_escape_string($conn, $keterangan);

    // Query untuk update kolom keterangan berdasarkan IdResep
    $sql = "UPDATE tambahresep SET keterangan = ? WHERE IdResep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $keterangan, $idresep);

    if ($stmt->execute()) {
        // Jika berhasil, kembali ke halaman utama
        header("Location: index.php?status=success");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
