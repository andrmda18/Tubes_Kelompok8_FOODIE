<?php
include "../dbconfig.php"; // Koneksi ke database
include "../template/mainheader.php"; // Header

// Cek jika user sudah login
if (!isset($_SESSION['username'])) {
    echo "Silakan login terlebih dahulu.";
    exit;
}

// Cek jika keranjang kosong
if (empty($_SESSION['cart'])) {
    echo "Keranjang Anda kosong.";
    exit;
}

// Menampilkan keranjang
$totalHarga = 0;
?>

<div class="row mt-3 mb-4">
    <div class="col-md-6">
        <h4>Keranjang Belanja</h4>
    </div>
</div>

<table class="table table-striped table-hover">
    <thead align="center">
        <th>ID Produk</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Kuantitas</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php
        foreach ($_SESSION['cart'] as $id_produk => $item) {
            // Ambil data produk berdasarkan ID
            $sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
            $query = mysqli_query($conn, $sql);
            $produk = mysqli_fetch_assoc($query);

            // Hitung total harga untuk setiap produk
            $totalProduk = $produk['harga'] * $item['quantity'];
            $totalHarga += $totalProduk;
        ?>
            <tr>
                <td><?= $produk["id_produk"] ?></td>
                <td><?= $produk["nama_produk"] ?></td>
                <td><?= number_format($produk["harga"], 2, ',', '.') ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($totalProduk, 2, ',', '.') ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<div class="row mt-4">
    <div class="col-md-6">
        <h5>Total Harga: <?= number_format($totalHarga, 2, ',', '.') ?></h5>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a href="checkout.php" class="btn btn-success">Proses Pesanan</a>
    </div> -->
</div>

<?php
include "../template/mainfooter.php"; // Footer
?>