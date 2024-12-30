<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Top Up Koin</h2>
        <p class="text-center">Isi ulang koin Anda untuk menikmati berbagai fitur</p>
        
        <div class="card p-4">
            <form>
                <!-- Jumlah Koin -->
                <div class="mb-3">
                    <label for="jumlahKoin" class="form-label">Jumlah Koin</label>
                    <input type="number" class="form-control" id="jumlahKoin" placeholder="Masukkan jumlah koin" required>
                    <small class="form-text text-muted">1 Koin = Rp 1000</small>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-select" id="metodePembayaran" required>
                        <option selected>Pilih Metode Pembayaran</option>
                        <option value="bank">Transfer Bank</option>
                        <option value="ewallet">eWallet (GoPay, OVO, dll.)</option>
                        <option value="kartu">Kartu Kredit/Debit</option>
                    </select>
                </div>

                <!-- Total Pembayaran -->
                <div class="mb-3">
                    <label for="totalPembayaran" class="form-label">Total Pembayaran</label>
                    <input type="text" class="form-control" id="totalPembayaran" disabled value="Rp 0">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary w-100">Top Up Sekarang</button>
            </form>
        </div>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-link">Kembali ke Halaman Utama</a>
            <a href="#" class="btn btn-link">Bantuan & Dukungan</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
