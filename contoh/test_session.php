<?php
// Tentukan harga per koin dan biaya admin
$hargaPerKoin = 1000;  // Harga per koin (Rp 1000)
$biayaAdmin = 50000;   // Biaya admin (Rp 50.000)
$totalPembayaran = 0;  // Default total pembayaran
$nominal = 0;          // Default nominal

// Jika formulir sudah disubmit (ini digunakan untuk testing dan memanipulasi data melalui PHP)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlahKoin = isset($_POST['jumlahKoin']) ? (int)$_POST['jumlahKoin'] : 0;
    if ($jumlahKoin > 0) {
        $nominal = $jumlahKoin * $hargaPerKoin;
        $totalPembayaran = $nominal + $biayaAdmin;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Fungsi untuk menghitung total pembayaran secara dinamis
        function updateTotal() {
            var hargaPerKoin = 1000;  // Harga per koin
            var biayaAdmin = 50000;   // Biaya admin
            var jumlahKoin = document.getElementById('jumlahKoin').value;
            
            if (jumlahKoin) {
                var nominal = jumlahKoin * hargaPerKoin;
                var totalPembayaran = nominal + biayaAdmin;
                
                // Update rincian pembayaran
                document.getElementById('nominal').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(nominal);
                document.getElementById('biayaAdmin').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(biayaAdmin);
                document.getElementById('totalPembayaran').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPembayaran);
                
                // Tampilkan tabel rincian pembayaran
                document.getElementById('rincianPembayaran').style.display = 'block';
            } else {
                // Sembunyikan rincian pembayaran jika tidak ada jumlah koin yang dipilih
                document.getElementById('rincianPembayaran').style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Top Up Koin</h2>
        <p class="text-center">Isi ulang koin Anda</p>
        
        <div class="card p-4">
            <form method="POST">
                <!-- Jumlah Koin -->
                <div class="mb-3">
                    <label for="jumlahKoin" class="form-label">Jumlah Koin</label>
                    <select class="form-select" id="jumlahKoin" name="jumlahKoin" onchange="updateTotal()" required>
                        <option value="" disabled selected>Pilih jumlah koin</option>
                        <option value="1000">1000 Koin (Rp 1.000.000)</option>
                        <option value="2000">2000 Koin (Rp 2.000.000)</option>
                        <option value="3000">3000 Koin (Rp 3.000.000)</option>
                        <option value="5000">5000 Koin (Rp 5.000.000)</option>
                        <option value="10000">10000 Koin (Rp 10.000.000)</option>
                    </select>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="metodePembayaran" name="metodePembayaran" required>
                        <option value="qris" selected>QRIS</option>
                    </select>
                </div>

                <!-- Rincian Pembayaran (Dihide terlebih dahulu) -->
                <div id="rincianPembayaran" style="display: none;">
                    <h5>Rincian Pembayaran</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Harga Koin</td>
                                <td id="nominal">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Biaya Admin</td>
                                <td id="biayaAdmin">Rp 50.000</td>
                            </tr>
                            <tr>
                                <td><strong>Total Pembayaran</strong></td>
                                <td id="totalPembayaran">Rp 0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary w-100">Top Up Sekarang</button>
            </form>
        </div>

        <div class="text-center mt-4">
            <a href="home.php" class="btn btn-link">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
