<?php
// Pengaturan koneksi ke database
include('../dbconfig.php'); // Sesuaikan dengan lokasi file dbconfig.php

// Memulai sesi (hanya jika belum ada sesi yang aktif)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah 'username' sudah ada dalam session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo "Username tidak ditemukan di session.";
    exit; // Hentikan eksekusi jika data tidak ada
}

// Mengambil data koin dan harga dari form POST
if (isset($_POST['koin']) && isset($_POST['harga'])) {
    $koin = $_POST['koin'];
    $harga = $_POST['harga'];

    // Validasi koin dan harga
    if ($koin > 0 && $harga > 0) {
        // Query untuk mengambil saldo koin dari database berdasarkan username
        $sql = "SELECT koin FROM login WHERE username = ?"; // Menggunakan username sebagai kunci pencarian
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);  // 's' untuk string (username)
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($coins_balance);
            $stmt->fetch();

            // Menambahkan koin ke saldo pengguna
            $newBalance = $coins_balance + $koin;

            // Update saldo koin pengguna
            $updateSql = "UPDATE login SET koin = ? WHERE username = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("is", $newBalance, $username);  // 'i' untuk integer (newBalance) dan 's' untuk string (username)

            if ($updateStmt->execute()) {
                $successMsg = "Topup berhasil! Saldo koin baru Anda: " . $newBalance;
                header("Location: home.php?successMsg=" . urlencode($successMsg));

            } else {
                echo "Terjadi kesalahan saat melakukan topup.";
            }
            $updateStmt->close();
        } else {
            echo "Pengguna dengan username tersebut tidak ditemukan.";
        }
        $stmt->close();
    } else {
        echo "Jumlah koin atau harga tidak valid.";
    }
} else {
    echo "Data koin atau harga tidak ditemukan.";
}

$conn->close();
?>
