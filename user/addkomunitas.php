<?php
include "../dbconfig.php"; // Memastikan file konfigurasi database diimpor dengan benar
session_start(); // Memulai sesi untuk mengambil informasi login pengguna

// Mendapatkan username pengguna yang login
$logged_in_user = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Menangani pengiriman form
if (isset($_POST['btnSimpan'])) {
    // Mengambil data langsung dari POST tanpa sanitasi
    $nama_komunitas = $_POST['nama_komunitas'];
    $deskripsi = $_POST['deskripsi'];
    $anggota = $_POST['anggota']; // Array username anggota

    // Validasi input
    if (empty($nama_komunitas) || empty($deskripsi) || empty($anggota)) {
        echo "Semua field wajib diisi!";
        exit;
    }

    // Gabungkan array anggota menjadi string dengan koma sebagai pemisah
    $anggota_str = implode(',', $anggota); 

    // Query untuk insert data komunitas ke tabel `komunitas` dengan kolom anggota yang berisi daftar username
    $sqlStatement = "INSERT INTO komunitas (nama_komunitas, deskripsi, anggota) 
                     VALUES ('$nama_komunitas', '$deskripsi', '$anggota_str')";
    if (mysqli_query($conn, $sqlStatement)) {
        // Ambil ID komunitas yang baru dimasukkan
        $komunitas_id = mysqli_insert_id($conn);

        // Redirect ke halaman komunitas yang telah dibuat
        header("Location: indexdetail.php?komunitas_id=$komunitas_id");
        exit;
    } else {
        // Tampilkan pesan error jika gagal membuat komunitas
        $errMsg = "Gagal membuat komunitas! " . mysqli_error($conn);
        echo $errMsg;
    }
}

// Mengambil daftar anggota dari tabel `login`, kecuali admin yang login
$result = $conn->query("SELECT username, nama FROM login WHERE username != '$logged_in_user'");
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

mysqli_close($conn); // Tutup koneksi database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Komunitas</title>
</head>
<body>
    <h1>Buat Komunitas Baru</h1>
    <form action="" method="POST">
        <label for="nama_komunitas">Nama Komunitas:</label><br>
        <input type="text" id="nama_komunitas" name="nama_komunitas" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea><br><br>

        <label for="anggota">Pilih Anggota:</label><br>
        <select id="anggota" name="anggota[]" multiple required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['username'] ?>">
                    <?= $user['nama'] ?> (<?= $user['username'] ?>)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit" name="btnSimpan">Buat Komunitas</button>
    </form>
</body>
</html>
