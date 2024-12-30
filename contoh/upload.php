<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Penarikan Koin</h2>
        <p class="text-center">Tarik koin Anda menjadi uang tunai dengan mudah</p>
        
        <div class="card p-4">
            <form>
                <!-- Jumlah Koin -->
                <div class="mb-3">
                    <label for="jumlahKoinPenarikan" class="form-label">Jumlah Koin yang Ingin Ditarik</label>
                    <input type="number" class="form-control" id="jumlahKoinPenarikan" placeholder="Masukkan jumlah koin" required>
                </div>

                <!-- Metode Penarikan -->
                <div class="mb-3">
                    <label for="metodePenarikan" class="form-label">Metode Penarikan</label>
                    <select class="form-select" id="metodePenarikan" required>
                        <option selected>Pilih Metode Penarikan</option>
                        <option value="bank">Transfer Bank</option>
                        <option value="ewallet">eWallet (GoPay, OVO, dll.)</option>
                    </select>
                </div>

                <!-- Total Uang yang Akan Diterima -->
                <div class="mb-3">
                    <label for="totalUang" class="form-label">Total Uang yang Akan Diterima</label>
                    <input type="text" class="form-control" id="totalUang" disabled value="Rp 0">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary w-100">Tarik Sekarang</button>
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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Koin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Penarikan Koin</h2>
        <p class="text-center">Tarik koin Anda menjadi uang tunai dengan mudah</p>
        
        <div class="card p-4">
            <form>
                <!-- Jumlah Koin -->
                <div class="mb-3">
                    <label for="jumlahKoinPenarikan" class="form-label">Jumlah Koin yang Ingin Ditarik</label>
                    <input type="number" class="form-control" id="jumlahKoinPenarikan" placeholder="Masukkan jumlah koin" required>
                </div>

                <!-- Metode Penarikan -->
                <div class="mb-3">
                    <label for="metodePenarikan" class="form-label">Metode Penarikan</label>
                    <select class="form-select" id="metodePenarikan" required>
                        <option selected>Pilih Metode Penarikan</option>
                        <option value="bank">Transfer Bank</option>
                        <option value="ewallet">eWallet (GoPay, OVO, dll.)</option>
                    </select>
                </div>

                <!-- Total Uang yang Akan Diterima -->
                <div class="mb-3">
                    <label for="totalUang" class="form-label">Total Uang yang Akan Diterima</label>
                    <input type="text" class="form-control" id="totalUang" disabled value="Rp 0">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-primary w-100">Tarik Sekarang</button>
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
