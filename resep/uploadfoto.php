<?php
include "../dbconfig.php";

// Proses upload jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan file yang diupload
    $fileTmpName = $_FILES['foto']['tmp_name'];
    $fileName = $_FILES['foto']['name'];
    $fileSize = $_FILES['foto']['size'];
    $fileError = $_FILES['foto']['error'];

    // Validasi jika file ada dan tidak ada error
    if ($fileError === 0) {
        // Validasi ukuran file (misalnya 10MB)
        if ($fileSize > 10485760) { // 10MB
            echo "File terlalu besar. Maksimal ukuran file adalah 10MB.";
            exit;
        }

        // Validasi tipe file
        $allowedTypes = ['image/jpeg', 'image/png', 'video/mp4', 'video/webm']; // Sesuaikan dengan format yang diinginkan
        $fileType = mime_content_type($fileTmpName);

        if (!in_array($fileType, $allowedTypes)) {
            echo "Tipe file tidak valid. Hanya gambar (JPEG, PNG) dan video (MP4, WebM) yang diizinkan.";
            exit;
        }

        // Baca file menjadi data biner
        $fotoData = file_get_contents($fileTmpName);

        // Query untuk menyimpan data BLOB ke database
        $stmt = $conn->prepare("INSERT INTO tambahresep (foto) VALUES (?)");
        $stmt->bind_param("b", $fotoData);

        if ($stmt->execute()) {
            echo "Foto/Video '$fileName' berhasil diupload dan disimpan dalam database.";
        } else {
            echo "Terjadi kesalahan saat menyimpan foto/video: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto atau Video</title>
</head>
<body>
    <h1>Upload Foto atau Video</h1>
    <form action="upload_foto_video.php" method="POST" enctype="multipart/form-data">
        <label for="foto">Pilih Foto atau Video:</label><br>
        <input type="file" id="foto" name="foto" accept="image/*,video/*" required><br><br>

        <button type="submit">Upload Foto/Video</button>
    </form>
</body>
</html>
