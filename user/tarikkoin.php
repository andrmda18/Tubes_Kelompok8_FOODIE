<?php
session_start();
include "../dbconfig.php";

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit();
}

$username = $_SESSION['username'];
$rincianPembayaran = null;

// Ambil daftar koin dari database
$query = "SELECT * FROM transaksi WHERE idTransaksi > 4";
$result = mysqli_query($conn, $query);
$daftarKoin = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Ambil nomor e-wallet user
$queryEwallet = "SELECT nomor_ewallet FROM koin WHERE username = '$username' LIMIT 1";
$resultEwallet = mysqli_query($conn, $queryEwallet);
$dataEwallet = mysqli_fetch_assoc($resultEwallet);
$nomorEwallet = $dataEwallet['nomor_ewallet'] ?? null;

// Jika nomor e-wallet tidak ditemukan, tampilkan modal untuk update
$showModal = !$nomorEwallet;

// Proses pilih jumlah koin
if (isset($_POST['idTransaksi'])) {
    $idTransaksi = $_POST['idTransaksi'];

    // Ambil data transaksi yang dipilih
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE idTransaksi='$idTransaksi'");
    $rincianPembayaran = mysqli_fetch_assoc($query);

    if ($rincianPembayaran) {
        // Simpan data ke session
        $_SESSION['idTransaksi'] = $idTransaksi;
        $_SESSION['jumlahKoin'] = $rincianPembayaran['jumlahKoin'];
        $_SESSION['hargaKoin'] = $rincianPembayaran['hargaKoin'];
        $_SESSION['biayaAdmin'] = $rincianPembayaran['biayaAdmin'];
        $_SESSION['totalPembayaran'] = $rincianPembayaran['hargaKoin'] - $rincianPembayaran['biayaAdmin'];
    }
}

// Proses submit penarikan
if (isset($_POST['submit'])) {
    $idTransaksi = $_SESSION['idTransaksi'];
    $jumlahKoin = $_SESSION['jumlahKoin'];
    $tanggal = date('Y-m-d H:i:s');

    $query = "INSERT INTO koin (username, idTransaksi, jumlahtransaksi, nomor_ewallet, tanggal, status, riwayat_transaksi) 
              VALUES ('$username', '$idTransaksi', '$jumlahKoin', '$nomorEwallet', '$tanggal', 'menunggu', 'penarikan')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Penarikan berhasil diajukan dan akan diproses oleh admin');
            window.location='home.php';
        </script>";
        exit;
    }
}

// Proses update nomor e-wallet
if (isset($_POST['updateEwallet'])) {
    $nomorEwallet = $_POST['nomorEwallet'];

    // Update nomor e-wallet di database
    $queryUpdate = "UPDATE koin SET nomor_ewallet = '$nomorEwallet' WHERE username = '$username'";
    if (mysqli_query($conn, $queryUpdate)) {
        echo "<script>
            alert('Nomor e-wallet berhasil diperbarui!');
            window.location = 'tarikkoin.php';
        </script>";
    } else {
        echo "<script>alert('Gagal memperbarui nomor e-wallet.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .withdrawal-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="withdrawal-form">
            <h2 class="text-center mb-4">Penarikan Koin</h2>
            <div class="card p-4">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Jumlah Koin</label>
                        <select class="form-select" name="idTransaksi" onchange="this.form.submit()" required>
                            <option value="">Pilih jumlah koin</option>
                            <?php foreach ($daftarKoin as $koin): ?>
                                <option value="<?= $koin['idTransaksi'] ?>" <?= (isset($_POST['idTransaksi']) && $_POST['idTransaksi'] == $koin['idTransaksi']) ? 'selected' : '' ?>>
                                    Jumlah Koin: <?= $koin['jumlahKoin'] ?> - Harga: Rp <?= number_format($koin['hargaKoin'], 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor E-Wallet</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($nomorEwallet) ?>" readonly>
                    </div>

                    <?php if (isset($_SESSION['idTransaksi'])): ?>
                        <div class="mt-4">
                            <h5>Rincian Penarikan</h5>
                            <p>Jumlah Koin: <?= $_SESSION['jumlahKoin'] ?></p>
                            <p>Harga Koin: Rp <?= number_format($_SESSION['hargaKoin'], 0, ',', '.') ?></p>
                            <p>Biaya Admin: Rp <?= number_format($_SESSION['biayaAdmin'], 0, ',', '.') ?></p>
                            <p><strong>Total Penarikan: Rp <?= number_format($_SESSION['totalPembayaran'], 0, ',', '.') ?></strong></p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Proses Penarikan</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update E-Wallet -->
    <div class="modal fade" id="ewalletModal" tabindex="-1" aria-labelledby="ewalletModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ewalletModalLabel">Update Nomor E-Wallet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nomor E-Wallet</label>
                            <input type="text" class="form-control" name="nomorEwallet" required>
                        </div>
                        <button type="submit" name="updateEwallet" class="btn btn-primary w-100">Update E-Wallet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Show Modal if No E-Wallet -->
    <script>
        <?php if ($showModal): ?>
            $(document).ready(function(){
                $('#ewalletModal').modal('show');
            });
        <?php endif; ?>
    </script>
</body>
</html>
