<?php
session_start();
include "../dbconfig.php";

// Pastikan username ada dalam session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil username dari session
} else {
    echo "Username tidak ditemukan!";
    exit();
}

$sqlSaldo = " SELECT username,
        SUM(CASE WHEN riwayat_transaksi = 'top up' THEN jumlahtransaksi ELSE 0 END) AS total_masuk,
        SUM(CASE WHEN riwayat_transaksi = 'feedback' THEN jumlahtransaksi ELSE 0 END) AS total_keluar,
        SUM(CASE WHEN riwayat_transaksi = 'pemberian' THEN jumlahtransaksi ELSE 0 END) AS total_pemberian,
        SUM(CASE WHEN riwayat_transaksi = 'penarikan' THEN jumlahtransaksi ELSE 0 END) AS total_penarikan,
        (
            (SUM(CASE WHEN riwayat_transaksi = 'top up' THEN jumlahtransaksi ELSE 0 END) - 
             SUM(CASE WHEN riwayat_transaksi = 'pemberian' THEN jumlahtransaksi ELSE 0 END)) - 
            (SUM(CASE WHEN riwayat_transaksi = 'feedback' THEN jumlahtransaksi ELSE 0 END) + 
             SUM(CASE WHEN riwayat_transaksi = 'penarikan' THEN jumlahtransaksi ELSE 0 END))
        ) AS saldo
        FROM koin
        WHERE username = '$username' AND status = 'berhasil'
        GROUP BY username";
$saldo = mysqli_query($conn, $sqlSaldo);
// Cek apakah ada data yang ditemukan
if ($saldo && mysqli_num_rows($saldo) > 0) {
    // Ambil satu baris data
    $saldo = mysqli_fetch_assoc($saldo);
} else {
    echo "Data tidak ditemukan untuk username: $username";
    exit;
}

$sqlStatement = "SELECT * FROM koin
                WHERE username = '$username'";
$sql = mysqli_query($conn, $sqlStatement);

$riwayat = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$pengguna = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto, username FROM login WHERE username = '$username'"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koin Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .circle-img {
            width: 35px; /* Ukuran lebar gambar */
            height: 35px; /* Ukuran tinggi gambar (harus sama dengan lebar untuk hasil bulat) */
            border-radius: 50%; /* Membuat sudut gambar menjadi bulat */
            object-fit: cover; /* Memastikan gambar tetap proporsional */
            border: 2px solid #f09133; /* (Opsional) Tambahkan border untuk tampilan */
            margin-bottom: 10px;
            }
    </style>
</head>
<body>
    <header class="bg-success text-white text-center py-3 position-relative">
        <h1>Koin Saya</h1>
        <div class="position-absolute top-0 end-0 p-3 d-flex align-items-center">
            <!-- User Profile -->
            <div class="d-flex align-items-center">
                <span class="fw-bold"><?= $pengguna['username']; ?></span>
                <img src="../images/<?= $pengguna['foto']; ?>" alt="Profile Saya" class="rounded-circle me-2 circle-img">
            </div>
        </div>
    </header>

    <div class="container my-4">
        <!-- koin saya start -->
        <div class="card mb-4">
            <div class="card-body">
            <h2 class="card-title">Koin Kamu</h2>
            <p class="card-text"><strong>Total Koin:</strong> <span id="coin-balance" class="fw-bold"><?= $saldo['saldo']; ?></span></p>
            </div>
        </div>
        <!-- koin saya end -->

        <!-- riwayat start -->
        <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">Riwayat Transaksi</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-history">
                        <?php if (count($riwayat) > 0): ?>
                            <!-- Jika ada riwayat transaksi -->
                            <?php foreach ($riwayat as $transaksi): ?>
                                <tr>
                                    <td><?= $transaksi['tanggal']; ?></td>
                                    <td><?= $transaksi['riwayat_transaksi']; ?></td>
                                    <td><?= $transaksi['jumlahtransaksi']; ?></td>
                                    <td><?= $transaksi['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Jika tidak ada riwayat transaksi -->
                            <tr>
                                <td colspan="3" class="text-center">Belum Ada Transaksi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- riwayat end -->
        <div class="card">
            <div class="card-body">
                <!-- <h2 class="card-title">Actions</h2> -->
                <a href="topupkoin.php"><button class="btn btn-success me-2" onclick="topUpCoins()">Top Up Koin</button></a>
                <a href="tarikkoin.php"><button class="btn btn-warning" onclick="withdrawCoins()">Tarik Koin</button></a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>