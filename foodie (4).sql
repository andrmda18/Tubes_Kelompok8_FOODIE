-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2025 pada 03.35
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodie`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idKategori`, `namaKategori`, `foto`) VALUES
(0, 'Default', ''),
(3, 'Masakan Padang', '1734454701_food.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koin`
--

CREATE TABLE `koin` (
  `idKoin` int(11) NOT NULL,
  `idTransaksi` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nomor_ewallet` varchar(12) NOT NULL,
  `riwayat_transaksi` varchar(255) NOT NULL,
  `jumlahtransaksi` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `buktiPembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koin`
--

INSERT INTO `koin` (`idKoin`, `idTransaksi`, `username`, `nomor_ewallet`, `riwayat_transaksi`, `jumlahtransaksi`, `tanggal`, `status`, `buktiPembayaran`) VALUES
(13, 1, 'inulmonia', '082156782345', 'top up', 20, '2025-01-01 16:47:25', 'menunggu', 'images/20250101104725_Screenshot (1032).png'),
(14, 1, 'inulmonia', '082156782345', 'top up', 20, '2025-01-01 17:06:08', 'menunggu', 'images/20250101110608_2020-08-07.png'),
(16, 1, 'jaja', '081367859023', 'top up', 20, '2025-01-01 20:06:36', 'berhasil', '1735736796_1.png'),
(17, 2, 'inulmonia', '082156782345', 'top up', 40, '2025-01-01 21:52:14', 'berhasil', '1735743133_WhatsApp Image 2024-12-27 at 00.03.46.jpeg'),
(18, 7, 'inulmonia', '082156782345', 'penarikan', 200, '2025-01-01 19:02:02', 'berhasil', NULL),
(19, 3, 'inulmonia', '', 'top up', 250, '2025-01-02 02:12:34', 'menunggu', '1735758754_Screenshot 2025-01-02 014036.png'),
(20, 6, 'inulmonia', '082156782345', 'penarikan', 100, '2025-01-02 03:31:47', 'menunggu', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komunitas`
--

CREATE TABLE `komunitas` (
  `id` int(11) NOT NULL,
  `nama_komunitas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `anggota` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kataSandi` varchar(225) NOT NULL,
  `role` varchar(50) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `nama`, `email`, `kataSandi`, `role`, `foto`) VALUES
('inulmonia', 'inna', 'inna@gmail.com', '$2y$10$l1YSCtGWxGlLH9gOcdiR4O6Py7cYfwXsc3IS3.LStTu8GTRGC0CjW', 'user', '1733320392_hainan.jpg'),
('jaja', 'mikaila', 'jaja@gmail.com', '$2y$10$ZOq7tO7FpwbZ.vbcZH5P4OeXRSpTP/pQLbN1g77vRCst0IY5.2xnS', 'user', '1733329540_dessert.jpg'),
('lala', 'jumaila', 'lala@gmail.com', '$2y$10$ebGQYI2h6OpskMAD2D1IpOZVbeaZImPQaTXaJjTyj4uU/Qv8l6p0e', 'user', '1733334305_gohyong.webp'),
('yaya', 'jubaedah', 'yaya@gmail.com', '$2y$10$323LyPgzMqC.1dsJtTMz3.140D1/ouLytn9o3T8H5dTL4RPJKX8iW', 'admin', '1733333776_ramen.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tambahresep`
--

CREATE TABLE `tambahresep` (
  `IdResep` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `NamaResep` varchar(100) NOT NULL,
  `Bahan` text NOT NULL,
  `Langkah` text NOT NULL,
  `Kategori` varchar(255) NOT NULL,
  `Durasi` varchar(10) NOT NULL,
  `Deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `idKategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tambahresep`
--

INSERT INTO `tambahresep` (`IdResep`, `username`, `NamaResep`, `Bahan`, `Langkah`, `Kategori`, `Durasi`, `Deskripsi`, `foto`, `keterangan`, `idKategori`) VALUES
(82, 'inulmonia', 'Gohyung', 'Kayu manis - 2 batang (bisa gunakan bubuk kayu manis 1 sdm),\r\nBunga lawang (star anise) - 4 buah,\r\nCengkeh - 1 sdt,\r\nLada Sichuan (atau lada biasa) - 1 sdm,\r\nAdas manis (fennel seeds) - 1 sdt', '- Sangrai Rempah\r\nPanaskan wajan dengan api kecil.\r\nSangrai semua rempah (kecuali kayu manis jika sudah bubuk) selama 2 sampai 3 menit hingga harum. Jangan sampai gosong.\r\n- Dinginkan Rempah\r\nAngkat rempah dari wajan dan biarkan hingga benar-benar dingin.', '', '30 Menit', 'bumbu campuran lima rempah yang sering digunakan dalam masakan Tiongkok dan Asia lainnya. Bumbu ini dikenal karena memberikan aroma khas, kaya rasa, dan keseimbangan antara manis, pahit, asin, dan pedas.', '1734458854_gohyong.webp', 'Disetujui', 3),
(83, 'inulmonia', 'Ayam Bawang Goreng', 'jsfgsfg, jsfg, jkgfkjshfg, jsghksfg', '- jksgjs;gf\r\n- jglksjgls\r\n- kjlkgjsg\r\n- kskflgsfg', '', '30 Menit', 'jkhadufebialhfa', '1734574334_ayam bawang putih.jpg', 'Disetujui', 3),
(84, 'inulmonia', '', '', '', '', '', '', '1734616281_296476.jpg', 'Ditolak', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `hargaKoin` int(11) NOT NULL,
  `jumlahKoin` int(11) NOT NULL,
  `biayaAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `hargaKoin`, `jumlahKoin`, `biayaAdmin`) VALUES
(1, 10000, 50, 2000),
(2, 20000, 100, 2000),
(3, 50000, 250, 2000),
(4, 100000, 500, 2000),
(5, 5000, 50, 2000),
(6, 10000, 100, 2000),
(7, 20000, 200, 2000),
(8, 50000, 500, 2000),
(9, 0, 0, 0),
(10, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indeks untuk tabel `koin`
--
ALTER TABLE `koin`
  ADD PRIMARY KEY (`idKoin`),
  ADD KEY `username` (`username`),
  ADD KEY `idTransaksi` (`idTransaksi`);

--
-- Indeks untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tambahresep`
--
ALTER TABLE `tambahresep`
  ADD PRIMARY KEY (`IdResep`),
  ADD KEY `username` (`username`),
  ADD KEY `idKategori` (`idKategori`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `koin`
--
ALTER TABLE `koin`
  MODIFY `idKoin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tambahresep`
--
ALTER TABLE `tambahresep`
  MODIFY `IdResep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `koin`
--
ALTER TABLE `koin`
  ADD CONSTRAINT `koin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`),
  ADD CONSTRAINT `koin_ibfk_2` FOREIGN KEY (`idTransaksi`) REFERENCES `transaksi` (`idTransaksi`);

--
-- Ketidakleluasaan untuk tabel `tambahresep`
--
ALTER TABLE `tambahresep`
  ADD CONSTRAINT `tambahresep_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`),
  ADD CONSTRAINT `tambahresep_ibfk_2` FOREIGN KEY (`idKategori`) REFERENCES `kategori` (`idKategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
