<?php
session_start();
include "dbconfig.php";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['kataSandi'];

// Query menggunakan prepared statement untuk keamanan (SQL injection prevention)
$sqlStatement = "SELECT * FROM login WHERE username=?";
$stmt = $conn->prepare($sqlStatement);
$stmt->bind_param("s", $username); // Bind parameter untuk mencegah SQL Injection
$stmt->execute();
$query = $stmt->get_result();
$row = $query->fetch_assoc();

if ($row == null) { // username tidak ditemukan
    $errMsg = "Username tidak terdaftar!";
    header("location:login.php?errorMsg=$errMsg");
    exit();
} else { // username ditemukan
    // Verifikasi password menggunakan password_verify()
    if (password_verify($password, $row['kataSandi'])) { // password yang dimasukkan cocok dengan hash
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        // Mengarahkan berdasarkan role
        switch ($row['role']) {
            case 'admin':
                header("location: admin/index.php");
                break;
            case 'user':
                header("location: user/home.php");
                break;
        }
        exit();
    } else {
        $errMsg = "Password salah!";
        header("location:login.php?errorMsg=$errMsg");
        exit();
    }
}

$stmt->close();
$conn->close();
?>
