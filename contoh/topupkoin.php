<?php
session_start();
include "../dbconfig.php";

// Pastikan username ada dalam session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo "Username tidak ditemukan!";
    exit();
}

// Ambil data transaksi dari database
$sqlStatement = "SELECT * FROM transaksi";
$query = mysqli_query($conn, $sqlStatement);
$transaksi = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Variabel untuk rincian pembayaran
$rincianPembayaran = null;
$biayaAdmin = 2000;

// Proses jika form disubmit untuk memilih jumlah koin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idTransaksi'])) {
    $idTransaksi = $_POST['idTransaksi'];

    // Cari rincian transaksi berdasarkan ID
    foreach ($transaksi as $koin) {
        if ($koin['idTransaksi'] == $idTransaksi) {
            $rincianPembayaran = $koin;
            break;
        }
    }

    // Simpan rincian pembayaran ke session untuk mempertahankan data setelah refresh
    $_SESSION['rincianPembayaran'] = $rincianPembayaran;
    $_SESSION['totalPembayaran'] = $rincianPembayaran['hargaKoin'] + $biayaAdmin;
}

// Proses jika tombol Top Up Sekarang ditekan
if (isset($_POST['topUp'])) {
    // Simpan path QRIS ke session (ganti dengan path gambar QRIS yang sesuai)
    $_SESSION['qrisImage'] = '../images/Pembayaran Foodie.png';

    // Redirect ke halaman qris.php
    header('Location: qris.php');
    exit();
}

// Ambil rincian pembayaran dari session jika ada
if (isset($_SESSION['rincianPembayaran'])) {
    $rincianPembayaran = $_SESSION['rincianPembayaran'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Top Up Koin</h2>
        <div class="card p-4">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="jumlahKoin" class="form-label">Jumlah Koin</label>
                    <select class="form-select" id="idTransaksi" name="idTransaksi" required onchange="this.form.submit()">
                        <option value="" disabled <?= !$rincianPembayaran ? 'selected' : ''; ?>>Pilih jumlah koin</option>
                        <?php
                        foreach ($transaksi as $koin) {
                            $selected = isset($rincianPembayaran) && $rincianPembayaran['idTransaksi'] == $koin['idTransaksi'] ? 'selected' : '';
                            echo "<option value='{$koin['idTransaksi']}' {$selected}>Jumlah Koin: {$koin['jumlahKoin']} - Harga: Rp " . number_format($koin['hargaKoin'], 0, ',', '.') . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="metodePembayaran" name="metodePembayaran" required>
                        <option value="qris" selected>QRIS</option>
                    </select>
                </div>

                <?php if ($rincianPembayaran): ?>
                    <div class="mt-4">
                        <h5>Rincian Pembayaran</h5>
                        <p>Jumlah Koin: <?= $rincianPembayaran['jumlahKoin']; ?></p>
                        <p>Harga: Rp <?= number_format($rincianPembayaran['hargaKoin'], 0, ',', '.'); ?></p>
                        <p>Biaya Admin: Rp <?= number_format($biayaAdmin, 0, ',', '.'); ?></p>
                        <p><strong>Total Pembayaran: Rp <?= number_format($rincianPembayaran['hargaKoin'] + $biayaAdmin, 0, ',', '.'); ?></strong></p>
                    </div>
                <?php endif; ?>

                <!-- Tombol submit untuk Top Up Sekarang -->
                <button type="submit" class="btn btn-primary w-100 mt-3" name="topUp">Top Up Sekarang</button>
            </form>
        </div>
    </div>
</body>
</html>
