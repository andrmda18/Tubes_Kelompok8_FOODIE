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

$sqlStatement = "SELECT * FROM transaksi";
$query = mysqli_query($conn, $sqlStatement);
$transaksi = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
        <p class="text-center">Isi ulang koin Anda</p>
        <div class="card p-4">
            <form method="POST">
                <div class="mb-3">
                <label for="jumlahKoin" class="form-label">Jumlah Koin</label>
                    <select class="form-select" id="idTransaksi" name="idTransaksi" onchange="updateTotal()" required>
                        <option value="" disabled selected>Pilih jumlah koin</option>
                        <?php
                        foreach ($transaksi as $key => $koin) {
                            $jumlahKoin = $koin['jumlahKoin'];
                            $hargaKoin = $koin['hargaKoin'];
                            echo "<option value='{$koin['idTransaksi']}' data-harga='{$hargaKoin}'>Jumlah Koin: {$jumlahKoin} - Harga: Rp " . number_format($hargaKoin, 0, ',', '.') . "</option>";
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
                <button type="submit" class="btn btn-primary w-100">Top Up Sekarang</button>
            </form>
        </div>        
    </div>
</body>
</html>