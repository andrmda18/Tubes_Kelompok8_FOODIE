<?php
include "../dbconfig.php";

// Ambil data transaksi yang masih menunggu
$query = "SELECT * FROM koin WHERE riwayat_transaksi = 'penarikan' AND status = 'menunggu' ORDER BY idKoin DESC";
$transaksi = mysqli_query($conn, $query);

// Proses validasi top-up
if (isset($_POST['btnValidasi'])) {
    $idTransaksi = $_POST['idTransaksi'];
    $statusBaru = $_POST['status'];
    $username = $_POST['username'];
    $jumlahKoin = $_POST['jumlahKoin'];

    // Update status transaksi
    $updateStatus = "UPDATE koin SET status = '$statusBaru' WHERE idKoin = '$idTransaksi'";
    
    if (mysqli_query($conn, $updateStatus)) {
        echo "<script>
            alert('Status transaksi berhasil diperbarui!');
            window.location='konfirmasitarik.php';
        </script>";
    } else {
        echo "<script>alert('Gagal memperbarui status!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Penarikan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="tambahkategori.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-1 p-0 sidebar">
            <ul>
                <li><a href="../logout.php"><img src="../images/LOGO.png" alt="logo" /></li></a>
                <li><a href="tambahkategori.php"><i class="bi bi-collection"></i></a></li>
                <li><a href="index.php"><i class="bi bi-folder-check"></i></a></li>
                <li><a href="konfirmasitopup.php"><i class="bi bi-coin"></i></a></li>
                <li><a href="konfirmasitarik.php"><i class="bi bi-wallet2"></i></a></li>
            </ul>
            </div>
            <div class="col main-content">
                <div class="card mt-3">
                    <div class="card-header text-center">
                        <h4>Validasi Top-Up</h4>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($transaksi) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                                <div class="border p-3 mb-4">
                                    <p><strong>Username:</strong> <?= htmlspecialchars($row['username']); ?></p>
                                    <p><strong>Jumlah Koin:</strong> <?= htmlspecialchars($row['jumlahtransaksi']); ?></p>
                                    <p><strong>Jenis Transaksi:</strong> <?= htmlspecialchars($row['riwayat_transaksi']); ?></p>
                                    <p><strong>Bukti Pembayaran:</strong></p>

                                    <form method="POST">
                                        <input type="hidden" name="idTransaksi" value="<?= htmlspecialchars($row['idKoin']); ?>">
                                        <input type="hidden" name="username" value="<?= htmlspecialchars($row['username']); ?>">
                                        <input type="hidden" name="jumlahKoin" value="<?= htmlspecialchars($row['jumlahtransaksi']); ?>">
                                        
                                        <select name="status" class="form-select mb-3" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="berhasil">Berhasil</option>
                                            <option value="gagal">Gagal</option>
                                        </select>
                                        
                                        <button type="submit" name="btnValidasi" class="btn btn-primary w-100">Simpan</button>
                                    </form>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-center">Tidak ada transaksi yang perlu divalidasi.</p>
                        <?php endif; ?>

                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>