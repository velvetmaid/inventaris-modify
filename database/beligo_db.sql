-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 30 Des 2022 pada 23.19
-- Versi server: 8.0.31-0ubuntu0.22.04.1
-- Versi PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beligo_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `table_barang_masuk`
--

CREATE TABLE `table_barang_masuk` (
  `kd_barang_masuk` varchar(7) NOT NULL,
  `kd_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `kd_jenis_barang` varchar(7) NOT NULL,
  `kd_supplier` varchar(7) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_barang` int NOT NULL,
  `stok_barang` int NOT NULL,
  `stok_masuk` int NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `table_barang_masuk`
--

INSERT INTO `table_barang_masuk` (`kd_barang_masuk`, `kd_barang`, `nama_barang`, `kd_jenis_barang`, `kd_supplier`, `tanggal_masuk`, `harga_barang`, `stok_barang`, `stok_masuk`, `gambar`, `keterangan`) VALUES
('BM001', 'BR001', 'Monitor', 'ME001', 'DS001', '2022-12-29', 450000, 15, 15, '', 'Monitor Samsung 22Inch'),
('BM002', 'BR001', 'Monitor', 'ME001', 'DS001', '2022-12-29', 450000, 40, 25, '', 'Monitor Samsung 22Inch'),
('BM003', 'BR001', 'Monitor', 'ME001', 'DS001', '2022-12-29', 450000, 45, 5, '', 'Monitor Samsung 22Inch'),
('BM004', 'BR002', 'Keyboard', 'ME003', 'DS001', '2022-12-29', 120000, 10, 10, '', 'Mechanical'),
('BM005', 'BR002', 'Keyboard', 'ME003', 'DS001', '2022-12-29', 250000, 15, 15, '', 'Mechanical'),
('BM006', 'BR003', 'Permen', 'ME001', 'DS001', '2022-12-29', 500, 25, 25, '', 'Permen'),
('BM007', 'BR004', 'TV', 'ME003', 'DS001', '2022-12-30', 1000, 20, 20, '', 'Mechanical'),
('BM008', 'BR005', 'Router Cable Extension', 'JN006', 'SP002', '2022-12-30', 5000, 200, 200, '', 'Router Cable Extension Description');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `table_barang_masuk`
--
ALTER TABLE `table_barang_masuk`
  ADD PRIMARY KEY (`kd_barang_masuk`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `kd_jenis_barang` (`kd_jenis_barang`),
  ADD KEY `kd_supplier` (`kd_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
