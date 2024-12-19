-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2024 pada 02.58
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
(82, 'inulmonia', 'Gohyung', 'Kayu manis - 2 batang (bisa gunakan bubuk kayu manis 1 sdm),\r\nBunga lawang (star anise) - 4 buah,\r\nCengkeh - 1 sdt,\r\nLada Sichuan (atau lada biasa) - 1 sdm,\r\nAdas manis (fennel seeds) - 1 sdt', '- Sangrai Rempah\r\nPanaskan wajan dengan api kecil.\r\nSangrai semua rempah (kecuali kayu manis jika sudah bubuk) selama 2 sampai 3 menit hingga harum. Jangan sampai gosong.\r\n- Dinginkan Rempah\r\nAngkat rempah dari wajan dan biarkan hingga benar-benar dingin.', '', '30 Menit', 'bumbu campuran lima rempah yang sering digunakan dalam masakan Tiongkok dan Asia lainnya. Bumbu ini dikenal karena memberikan aroma khas, kaya rasa, dan keseimbangan antara manis, pahit, asin, dan pedas.', '1734458854_gohyong.webp', 'Disetujui', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tambahresep`
--
ALTER TABLE `tambahresep`
  MODIFY `IdResep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

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
