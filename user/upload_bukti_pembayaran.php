<?php
session_start();
include "../dbconfig.php";

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Ambil username dari session
} else {
    echo "Username tidak ditemukan!";
    exit();
}

// Mengambil data transaksi
if (isset($_POST['idTransaksi'])) {
    $idTransaksi = $_POST['idTransaksi'];
    
    // Ambil data transaksi
    $query = mysqli_query($conn, "SELECT * FROM transaksi WHERE idTransaksi='$idTransaksi'");
    $transaksi = mysqli_fetch_array($query);
    
    // Jika transaksi tidak ditemukan
    if (!$transaksi) {
        echo "<script>alert('Data transaksi tidak ditemukan!'); window.location='indexkoin.php';</script>";
        exit();
    }
}

// Proses upload bukti pembayaran
if (isset($_POST['btnSimpan'])) {
    
    $foto = $_FILES['buktiPembayaran'];
    
    // Cek apakah ada file yang diupload
    if ($foto['name'] == '') {
        echo "<script>alert('Pilih file terlebih dahulu!');</script>";
    } else {
        // Cek tipe file (hanya jpg, jpeg, png)
        $tipe_file = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        if ($tipe_file != 'jpg' && $tipe_file != 'jpeg' && $tipe_file != 'png') {
            echo "<script>alert('Hanya file JPG, JPEG, dan PNG yang diperbolehkan!');</script>";
        } else {
            // Buat nama file baru
            $nama_file = time() . '_' . $foto['name'];
            
            // Upload file
            if (move_uploaded_file($foto['tmp_name'], '../images/' . $nama_file)) {
                // Simpan ke database
                $riwayat = 'top up';
                $jumlah_koin = $transaksi['jumlahKoin'];
                $foto_path = $nama_file;
                
                // Query untuk menyimpan data
                $simpan = mysqli_query($conn, "INSERT INTO koin (riwayat_transaksi, jumlahTransaksi, buktiPembayaran, username, idTransaksi) 
                                             VALUES ('$riwayat', '$jumlah_koin', '$foto_path', '$username', '$idTransaksi')");
                
                if ($simpan) {
                    // Update status transaksi
                    mysqli_query($conn, "UPDATE koin SET status='menunggu' WHERE idTransaksi='$idTransaksi'");
                    
                    // Simpan pesan sukses ke session
                    $_SESSION['success'] = "Bukti pembayaran berhasil diupload!";
                    
                    echo "<script>window.location='indexkoin.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Gagal menyimpan data!');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload file!');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Upload Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tampilkan username yang sedang login -->
                        <!-- <p class="text-muted">Login sebagai: <?php //echo $username//; ?></p> -->

                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idTransaksi" value="<?php echo $transaksi['idTransaksi']; ?>">
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="buktiPembayaran" accept=".jpg,.jpeg,.png" required>
                                <small class="text-muted">Format: JPG, JPEG, PNG</small>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="btnSimpan">
                                    Upload Bukti Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>