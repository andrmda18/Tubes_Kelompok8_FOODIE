<?php
session_start();

// Pastikan username ada dalam session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo "Username tidak ditemukan!";
    exit();
}

// Proses upload bukti pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['buktiPembayaran'])) {
    // Tentukan direktori tujuan untuk menyimpan file
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES['buktiPembayaran']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar
    if (getimagesize($_FILES['buktiPembayaran']['tmp_name']) === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file (misal maksimal 5MB)
    if ($_FILES['buktiPembayaran']['size'] > 5000000) {
        echo "File terlalu besar.";
        $uploadOk = 0;
    }

    // Hanya izinkan format file tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika semuanya oke, coba untuk meng-upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['buktiPembayaran']['tmp_name'], $targetFile)) {
            echo "File bukti pembayaran berhasil diunggah.";

            // Simpan data bukti pembayaran ke session atau database jika diperlukan
            $_SESSION['buktiPembayaran'] = $targetFile;

            // Arahkan pengguna ke halaman konfirmasi atau halaman lain
            header('Location: konfirmasi_pembayaran.php');
            exit();
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload Bukti Pembayaran</h2>
        <div class="card p-4">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="buktiPembayaran" class="form-label">Pilih Bukti Pembayaran</label>
                    <input class="form-control" type="file" id="buktiPembayaran" name="buktiPembayaran" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Upload Bukti Pembayaran</button>
            </form>
        </div>
    </div>
</body>
</html>
