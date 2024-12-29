<?php
// Ambil data paket koin
$paketKoin = [
    1 => ['koin' => 100, 'harga' => 20000],
    2 => ['koin' => 500, 'harga' => 95000],
    3 => ['koin' => 1000, 'harga' => 180000],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPaket = $_POST['id_paket'];
    $idPengguna = 1; // ID pengguna, sesuaikan dengan sesi login
    $buktiPembayaran = $_FILES['bukti_pembayaran'];

    // Validasi dan simpan bukti pembayaran
    if ($buktiPembayaran['error'] === UPLOAD_ERR_OK) {
        $filePath = 'uploads/' . basename($buktiPembayaran['name']);
        move_uploaded_file($buktiPembayaran['tmp_name'], $filePath);

        // Simpan transaksi ke database
        $db = new mysqli('localhost', 'root', '', 'topup_db');
        $stmt = $db->prepare("INSERT INTO transaksi (id_pengguna, id_paket, bukti_pembayaran) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $idPengguna, $idPaket, $filePath);
        $stmt->execute();
        $stmt->close();
        $db->close();

        echo "Bukti pembayaran berhasil diunggah. Harap menunggu konfirmasi.";
    } else {
        echo "Gagal mengunggah bukti pembayaran.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Top-Up Koin TikTok</title>
</head>
<body>
    <h1>Top-Up Koin TikTok</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="id_paket">Pilih Paket Koin:</label>
        <select name="id_paket" id="id_paket" required>
            <?php foreach ($paketKoin as $id => $paket): ?>
                <option value="<?= $id; ?>">
                    <?= $paket['koin']; ?> Koin - Rp<?= number_format($paket['harga'], 0, ',', '.'); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="bukti_pembayaran">Unggah Bukti Pembayaran:</label>
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required>
        <br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>
