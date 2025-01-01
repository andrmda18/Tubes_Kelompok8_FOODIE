<?php
// File: qris.php
session_start();
include "../dbconfig.php";

// Cek data pembayaran
if (!isset($_SESSION['totalPembayaran']) || !isset($_SESSION['idTransaksi'])) {
    echo "<script>alert('Data pembayaran tidak lengkap!'); window.location='topup.php';</script>";
    exit();
}

$totalPembayaran = $_SESSION['totalPembayaran'];
$qrisImage = $_SESSION['qrisImage'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <h2 class="text-center">Pembayaran QRIS</h2>
        <p class="text-center">Scan kode QRIS berikut untuk melakukan pembayaran</p>

        <div class="card p-4 text-center">
            <h5>Total Pembayaran:</h5>
            <h3 class="text-primary">Rp <?= number_format($totalPembayaran, 0, ',', '.') ?></h3>
            <img src="<?= $qrisImage ?>" alt="QRIS Pembayaran" class="img-fluid mx-auto" style="max-width: 300px;">
        </div>

        <div class="mt-4 text-center">
            <p>Silakan lakukan pembayaran dengan memindai kode QRIS di atas.</p>
            <form action="upload_bukti_pembayaran.php" method="POST">
                <input type="hidden" name="idTransaksi" value="<?= $_SESSION['idTransaksi'] ?>">
                <button type="submit" class="btn btn-primary w-100 mt-3">Upload Bukti Pembayaran</button>
            </form>
        </div>
    </div>
</body>
</html>