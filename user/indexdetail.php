<?php
include "../dbconfig.php"; // Memastikan file konfigurasi database diimpor dengan benar

// Mengambil daftar semua komunitas
$sqlKomunitas = "SELECT * FROM komunitas";
$resultKomunitas = $conn->query($sqlKomunitas);

$komunitas_list = [];
while ($row = $resultKomunitas->fetch_assoc()) {
    // Anggota sudah disimpan dalam kolom anggota sebagai string yang dipisahkan oleh koma
    $anggota = $row['anggota']; // Mengambil anggota dari kolom 'anggota'
    $row['anggota'] = $anggota; // Menyimpan anggota yang sudah ada dalam kolom

    // Menambahkan komunitas beserta anggotanya ke dalam list
    $komunitas_list[] = $row;
}

mysqli_close($conn); // Tutup koneksi database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Komunitas</title>
</head>
<body>
    <h1>Daftar Komunitas</h1>
    
    <?php if (isset($_GET['successMsg'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['successMsg']) ?></p>
    <?php endif; ?>

    <!-- Tombol untuk menambah komunitas -->
    <a href="addkomunitas.php" style="padding: 10px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Tambah Komunitas</a>
    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nama Komunitas</th>
                <th>Deskripsi</th>
                <th>Anggota</th> <!-- Kolom Anggota -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($komunitas_list as $komunitas): ?>
                <tr>
                    <td><?= htmlspecialchars($komunitas['nama_komunitas']) ?></td>
                    <td><?= htmlspecialchars($komunitas['deskripsi']) ?></td>
                    <td><?= htmlspecialchars($komunitas['anggota']) ?></td> <!-- Menampilkan anggota -->
                    <td>
                        <!-- Tombol Edit -->
                        <a href="edit.php?komunitas_id=<?= $komunitas['id'] ?>">Edit</a> |
                        <!-- Tombol Delete -->
                        <a href="delete.php?komunitas_id=<?= $komunitas['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus komunitas ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
