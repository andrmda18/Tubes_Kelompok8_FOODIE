<?php
// File: topup.php
session_start();
include "../dbconfig.php";

// Cek login
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit();
}

$username = $_SESSION['username'];

// Ambil data transaksi
$query = mysqli_query($conn, "SELECT * FROM transaksi");
$transaksi = mysqli_fetch_all($query, MYSQLI_ASSOC);

$rincianPembayaran = null;

// Proses pilih jumlah koin
if (isset($_POST['idTransaksi'])) {
    $idTransaksi = $_POST['idTransaksi'];
    
    // Ambil data transaksi yang dipilih
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE idTransaksi='$idTransaksi'");
    $rincianPembayaran = mysqli_fetch_array($query);
    
    if ($rincianPembayaran) {
        // Simpan data ke session
        $_SESSION['idTransaksi'] = $idTransaksi;
        $_SESSION['jumlahKoin'] = $rincianPembayaran['jumlahKoin'];
        $_SESSION['hargaKoin'] = $rincianPembayaran['hargaKoin'];
        $_SESSION['biayaAdmin'] = $rincianPembayaran['biayaAdmin'];
        $_SESSION['totalPembayaran'] = $rincianPembayaran['hargaKoin'] + $rincianPembayaran['biayaAdmin'];
    }
}

// Proses top up
if (isset($_POST['topUp'])) {
    if (isset($_SESSION['idTransaksi'])) {
        $_SESSION['qrisImage'] = '../images/Pembayaran Foodie.png';
        header('Location: qris.php');
        exit();
    } else {
        echo "<script>alert('Pilih jumlah koin terlebih dahulu!');</script>";
    }
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
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Jumlah Koin</label>
                    <select class="form-select" name="idTransaksi" required onchange="this.form.submit()">
                        <option value="" disabled <?= !isset($_SESSION['idTransaksi']) ? 'selected' : ''; ?>>
                            Pilih jumlah koin
                        </option>
                        <?php foreach ($transaksi as $t): ?>
                            <option value="<?= $t['idTransaksi'] ?>" 
                                <?= (isset($_SESSION['idTransaksi']) && $_SESSION['idTransaksi'] == $t['idTransaksi']) ? 'selected' : ''; ?>>
                                Jumlah Koin: <?= $t['jumlahKoin'] ?> - Harga: Rp <?= number_format($t['hargaKoin'], 0, ',', '.') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select class="form-select" name="metodePembayaran" required>
                        <option value="qris" selected>QRIS</option>
                    </select>
                </div>

                <?php if (isset($_SESSION['idTransaksi'])): ?>
                    <div class="mt-4">
                        <h5>Rincian Pembayaran</h5>
                        <p>Jumlah Koin: <?= $_SESSION['jumlahKoin'] ?></p>
                        <p>Harga: Rp <?= number_format($_SESSION['hargaKoin'], 0, ',', '.') ?></p>
                        <p>Biaya Admin: Rp <?= number_format($_SESSION['biayaAdmin'], 0, ',', '.') ?></p>
                        <p><strong>Total Pembayaran: Rp <?= number_format($_SESSION['totalPembayaran'], 0, ',', '.') ?></strong></p>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100 mt-3" name="topUp">Top Up Sekarang</button>
            </form>
        </div>
    </div>
</body>
</html>